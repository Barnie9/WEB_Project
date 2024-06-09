import { Dayjs } from "dayjs";
import { getIndexOfDayInWeek } from "../utils";
import { useAppDispatch, useAppSelector } from "../redux/hooks";
import {
	selectCurrentSelectedDate,
	setCurrentSelectedDate,
} from "../redux/slices/dateSlice";
import NumberButton from "./NumberButton";

type Props = {
	date: Dayjs;
};

const DayHeader = (props: Props) => {
	const dispatch = useAppDispatch();

	const currentSelectedDate = useAppSelector(selectCurrentSelectedDate);

	const IndexOfDayInWeek = getIndexOfDayInWeek(props.date);

	return (
		<div
			style={{
				gridRow: "1",
				gridColumn: `${IndexOfDayInWeek + 3}`,

				display: "flex",
				flexDirection: "column",
				justifyContent: "center",
				alignItems: "center",
				gap: "5px",
			}}
		>
			<div
				style={{
					fontSize: "1rem",
					color: currentSelectedDate.isSame(props.date, "day")
						? "var(--red-primary)"
						: "var(--gray)",
				}}
			>
				{props.date.format("ddd")}
			</div>

			<NumberButton
				number={props.date.format("D")}
				textColor={
					currentSelectedDate.isSame(props.date, "day")
						? "--white"
						: "--black"
				}
				backgroundColor={
					currentSelectedDate.isSame(props.date, "day")
						? "--red-primary"
						: "--white"
				}
				hoverBackgroundColor={
					currentSelectedDate.isSame(props.date, "day")
						? "--red-secondary"
						: "--light-gray"
				}
				onClick={() => dispatch(setCurrentSelectedDate(props.date))}
			/>
		</div>
	);
};

export default DayHeader;
