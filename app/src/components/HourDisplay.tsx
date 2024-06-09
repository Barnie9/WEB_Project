import { getHourFromNumber } from "../utils";

type Props = {
	hour: number;
};

const HourDisplay = (props: Props) => {
	const rowStart = 12 * props.hour + 3;

	return (
		<div
			style={{
				gridRowStart: `${rowStart}`,
				gridRowEnd: `${rowStart + 1}`,
				gridColumn: "1",

				display: "flex",
				justifyContent: "flex-end",
				alignItems: "center",
				height: "100%",
				fontSize: "0.7rem",
				color: "var(--gray)",
				gap: "5px",
			}}
		>
			{getHourFromNumber(props.hour)}
			<div
				style={{
					width: "10%",
					height: "1px",
					backgroundColor: "var(--light-gray)",
				}}
			></div>
		</div>
	);
};

export default HourDisplay;
