import { useLayoutEffect } from "react";
import {
	useGetAllEventsQuery,
	useGetFilteredEventsMutation,
} from "../redux/api/eventApi";
import { useGetUserGroupsQuery } from "../redux/api/userApi";
import { useAppSelector } from "../redux/hooks";
import { selectCurrentSelectedDate } from "../redux/slices/dateSlice";
import { selectUser } from "../redux/slices/userSlice";
import {
	getWeekDaysFromCurrentWeek,
	// generateCellsList,
	getSundayFromCurrentWeek,
	getSaturdayFromCurrentWeek,
} from "../utils";
import DayHeader from "./DayHeader";
// import EmptyCell from "./EmptyCell";
import EventCard from "./EventCard";
import HourDisplay from "./HourDisplay";

const WeekCalendar = () => {
	const currentSelectedDate = useAppSelector(selectCurrentSelectedDate);
	const user = useAppSelector(selectUser);

	const weekDays = getWeekDaysFromCurrentWeek(currentSelectedDate);

	const hours = Array.from({ length: 23 }, (_, i) => i + 1);

	// const emptyCells = generateCellsList(2, 290, 3, 9);

	const { data: groupIds, isSuccess: groupIdsIsSuccess } =
		useGetUserGroupsQuery(user!.id);
	const [getFilteredEvents, { data: events, isSuccess: eventsIsSuccess }] =
		useGetFilteredEventsMutation();

	useLayoutEffect(() => {
		if (groupIdsIsSuccess) {
			getFilteredEvents({
				groupIds: groupIds!.message,
				startDate:
					getSundayFromCurrentWeek(currentSelectedDate).toDate(),
				endDate:
					getSaturdayFromCurrentWeek(currentSelectedDate).toDate(),
			});
		}
	}, [groupIdsIsSuccess, currentSelectedDate]);

	// const { data: events, isSuccess: eventsIsSuccess } = useGetAllEventsQuery();

	return (
		<div
			style={{
				height: "100%",
				width: "100%",
				// width: "calc(100% - 3px)",
				display: "grid",
				gridTemplateColumns: "calc(9% - 1px) 1px repeat(7, 13%)",
				gridTemplateRows: "100px 1px repeat(288, 5px)",

				overflowY: "scroll",
			}}
		>
			<div
				style={{
					gridRowStart: "1",
					gridRowEnd: "-1",
					gridColumn: "2",
					backgroundColor: "var(--light-gray)",
				}}
			/>
			<div
				style={{
					gridRow: "2",
					gridColumnStart: "1",
					gridColumnEnd: "-1",
					backgroundColor: "var(--light-gray)",
				}}
			/>

			{weekDays.map((day, index) => {
				return <DayHeader key={"day-" + index} date={day} />;
			})}

			{hours.map((hour, index) => {
				return <HourDisplay key={"hour-" + index} hour={hour} />;
			})}

			{/* {emptyCells.map((cell, index) => {
				return <EmptyCell key={"empty-cell-" + index} cell={cell} />;
			})} */}

			{eventsIsSuccess &&
				events.message.map((event, index) => {
					return (
						<EventCard key={"event-card-" + index} event={event} />
					);
				})}
		</div>
	);
};

export default WeekCalendar;
