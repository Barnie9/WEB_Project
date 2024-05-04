import { PayloadAction, createSlice } from "@reduxjs/toolkit";
import { User } from "../interfaces/interfaces";
import { RootState } from "../store";

interface UserSliceState {
	user: User | null;
}

const initialState: UserSliceState = {
	user: null,
};

export const userSlice = createSlice({
	name: "user",
	initialState,
	reducers: {
		setUser: (state, action: PayloadAction<User>) => {
			state.user = action.payload;
		},
		clearUser: (state) => {
			state.user = null;
		},
	},
});

export const { setUser, clearUser } = userSlice.actions;

export const selectUser = (state: RootState) => state.userReducer.user;

export default userSlice.reducer;
