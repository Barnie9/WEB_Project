import { PayloadAction, createSlice } from "@reduxjs/toolkit";
import { RootState } from "../store";

interface LoginSliceState {
	email: string;
	password: string;
}

const initialState: LoginSliceState = {
	email: "",
	password: "",
};

export const loginSlice = createSlice({
	name: "login",
	initialState,
	reducers: {
		setEmail: (state, action: PayloadAction<string>) => {
			state.email = action.payload;
		},
		setPassword: (state, action: PayloadAction<string>) => {
			state.password = action.payload;
		},
		clearLoginState: (state) => {
			state.email = "";
			state.password = "";
		},
	},
});

export const { setEmail, setPassword, clearLoginState } = loginSlice.actions;

export const selectEmail = (state: RootState) => state.loginReducer.email;
export const selectPassword = (state: RootState) => state.loginReducer.password;

export default loginSlice.reducer;
