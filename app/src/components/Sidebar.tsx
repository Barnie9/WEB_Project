import { DateCalendar } from "@mui/x-date-pickers/DateCalendar";
import { useAppDispatch, useAppSelector } from "../redux/hooks";
import {
	selectCurrentSelectedDate,
	setCurrentSelectedDate,
} from "../redux/slices/dateSlice";

const Sidebar = () => {
	const dispatch = useAppDispatch();

	const currentSelectedDate = useAppSelector(selectCurrentSelectedDate);

	return (
		<div
			style={{
				display: "flex",
				flexDirection: "column",
				alignItems: "center",
				height: "100%",
				width: "calc(100% - 23px)",
				padding: "0 10px",
				gap: "10px",
				borderRight: "1px solid var(--light-gray)",
				overflowY: "auto",
			}}
		>
			<DateCalendar
				showDaysOutsideCurrentMonth
				fixedWeekNumber={6}
				value={currentSelectedDate}
				onChange={(newValue) =>
					dispatch(setCurrentSelectedDate(newValue))
				}
				sx={{
					minHeight: "350px",
					width: "100%",
					"& .MuiPickersDay-root": {
						"&.Mui-selected": {
							backgroundColor: "var(--light-blue-primary)",
							"&:hover": {
								backgroundColor: "var(--light-blue-secondary)",
							},
							"&:focus": {
								backgroundColor: "var(--light-blue-primary)",
							},
						},
					},
				}}
			/>
		</div>
	);
};

export default Sidebar;
