import { Dayjs } from "dayjs";
// import { Cell } from "./types";

export const getWeekDaysFromCurrentWeek = (currentDay: Dayjs) => {
	const days: Dayjs[] = [];

	for (let i = 0; i < 7; i++) {
		days.push(currentDay.startOf("week").add(i, "day"));
	}

	return days;
};

export const getSundayFromPastWeek = (currentDay: Dayjs) => {
	return currentDay.subtract(7, "day").startOf("week");
};

export const getSundayFromNextWeek = (currentDay: Dayjs) => {
	return currentDay.add(7, "day").startOf("week");
};

export const getSundayFromCurrentWeek = (currentDay: Dayjs) => {
	return currentDay.startOf("week").startOf("day").add(3, "hour");
};

export const getSaturdayFromCurrentWeek = (currentDay: Dayjs) => {
	return currentDay.endOf("week").endOf("day").add(3, "hour");
};

export const getIndexOfDayInWeek = (day: Dayjs) => {
	return day.day();
};

export const getHourFromNumber = (number: number) => {
	if (number < 10) {
		return `0${number}:00`;
	} else {
		return `${number}:00`;
	}
};

// export const generateCellsList = (
// 	startRow: number,
// 	endRow: number,
// 	startColumn: number,
// 	endColumn: number
// ): Cell[] => {
// 	const cells: Cell[] = [];

// 	for (let column = startColumn; column <= endColumn; column++) {
// 		for (let row = startRow; row <= endRow; row++) {
// 			cells.push({ row, column });
// 		}
// 	}

// 	return cells;
// };

export const getRowNumberFromDayjs = (day: Dayjs) => {
	return day.hour() * 12 + Math.floor(day.minute() / 5) + 3;
};
