import { createSlice } from "@reduxjs/toolkit";
import type { PayloadAction } from "@reduxjs/toolkit";
import type { RootState } from "../store";
import dayjs, { Dayjs } from "dayjs";

interface SliceProps {
	currentSelectedDate: Dayjs;
}

const initialState: SliceProps = {
	currentSelectedDate: dayjs(),
};

export const dateSlice = createSlice({
	name: "dateSlice",
	initialState,
	reducers: {
		setCurrentSelectedDate: (state, action: PayloadAction<Dayjs>) => {
			state.currentSelectedDate = action.payload;
		},
	},
});

export const { setCurrentSelectedDate } = dateSlice.actions;

export const selectCurrentSelectedDate = (state: RootState) =>
	state.dateSlice.currentSelectedDate;

export default dateSlice.reducer;
