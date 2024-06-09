import dayjs from "dayjs";
import { getIndexOfDayInWeek, getRowNumberFromDayjs } from "../utils";

type Props = {
	event: Event;
};

const EventCard = (props: Props) => {
    // const rowStart = getRowNumberFromDayjs(dayjs(props.event.startTime));
    // const rowEnd = getRowNumberFromDayjs(dayjs(props.event.endTime));
    // const column = getIndexOfDayInWeek(dayjs(props.event.startTime)) + 3;

	return (
		<div
			style={{
				// gridRowStart: `${rowStart}`,
                // gridRowEnd: `${rowEnd}`,
				// gridColumn: `${column}`,

                height: "100%",
                width: "100%",
				display: "flex",
				flexDirection: "column",
				justifyContent: "center",
				alignItems: "center",
                borderRadius: "5px",
				backgroundColor: "var(--blue-primary)",
			}}
		>
            {props.event.type}
        </div>
	);
};

export default EventCard;
