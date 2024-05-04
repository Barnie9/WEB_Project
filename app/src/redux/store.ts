import { configureStore } from "@reduxjs/toolkit";
import userSlice from "./slices/userSlice";
import loginSlice from "./slices/loginSlice";
import { loginApi } from "./api/loginApi";

export const store = configureStore({
	reducer: {
		loginReducer: loginSlice,
		userReducer: userSlice,
		loginApi: loginApi.reducer,
	},
	middleware: (getDefaultMiddleware) =>
		getDefaultMiddleware().concat(loginApi.middleware),
});

export type RootState = ReturnType<typeof store.getState>;

export type AppDispatch = typeof store.dispatch;
