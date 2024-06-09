import dayjs from "dayjs";
import { getIndexOfDayInWeek, getRowNumberFromDayjs } from "../utils";
import { Event } from "../redux/interfaces/interfaces";
import { useGetMatterByIdQuery } from "../redux/api/matterApi";
import { useGetRoomByIdQuery } from "../redux/api/roomApi";
import { useGetUserByIdQuery } from "../redux/api/userApi";

type Props = {
	event: Event;
};

const EventCard = (props: Props) => {
    const rowStart = getRowNumberFromDayjs(dayjs(props.event.start_time));
    const rowEnd = getRowNumberFromDayjs(dayjs(props.event.end_time));
    const column = getIndexOfDayInWeek(dayjs(props.event.start_time)) + 3;

	const { data: matter, isSuccess: matterIsSuccess } = useGetMatterByIdQuery(props.event.matter_id);
	const { data: room, isSuccess: roomIsSuccess } = useGetRoomByIdQuery(props.event.room_id);
	const { data: teacher, isSuccess: teacherIsSuccess } = useGetUserByIdQuery(props.event.teacher_id);

	return (
		<div
			style={{
				gridRowStart: `${rowStart}`,
                gridRowEnd: `${rowEnd}`,
				gridColumn: `${column}`,
                height: "100%",
                width: "100%",
				display: "flex",
				flexDirection: "column",
				justifyContent: "space-around",
				alignItems: "center",
                borderRadius: "5px",
				backgroundColor: "var(--light-blue-primary)",
				color: "var(--blue-primary)",
			}}
		>
			<div>{matter?.message.title}</div>
			<div>{room?.message.name}</div>
			<div>{teacher?.message.firstName} {teacher?.message.lastName}</div>
			<div>{props.event.type.toUpperCase()}</div>
        </div>
	);
};

export default EventCard;
