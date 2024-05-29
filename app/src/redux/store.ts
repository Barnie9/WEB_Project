import { configureStore } from "@reduxjs/toolkit";
import userSlice from "./slices/userSlice";
import loginSlice from "./slices/loginSlice";
import { loginApi } from "./api/loginApi";
import { matterApi } from "./api/matterApi";

export const store = configureStore({
	reducer: {
		loginReducer: loginSlice,
		userReducer: userSlice,
		loginApi: loginApi.reducer,
		matterApi: matterApi.reducer,
	},
	middleware: (getDefaultMiddleware) =>
		getDefaultMiddleware()
			.concat(loginApi.middleware)
			.concat(matterApi.middleware),
});

export type RootState = ReturnType<typeof store.getState>;

export type AppDispatch = typeof store.dispatch;
