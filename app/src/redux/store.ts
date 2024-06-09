import { configureStore } from "@reduxjs/toolkit";
import userSlice from "./slices/userSlice";
import loginSlice from "./slices/loginSlice";
import { loginApi } from "./api/loginApi";
import { matterApi } from "./api/matterApi";
import { roomApi } from "./api/roomApi";
import { groupApi } from "./api/groupApi";
import { userApi } from "./api/userApi";
import dateSlice from "./slices/dateSlice";
import { eventApi } from "./api/eventApi";

export const store = configureStore({
	reducer: {
		loginReducer: loginSlice,
		userReducer: userSlice,
		dateSlice: dateSlice,
		[loginApi.reducerPath]: loginApi.reducer,
		[matterApi.reducerPath]: matterApi.reducer,
		[roomApi.reducerPath]: roomApi.reducer,
		[groupApi.reducerPath]: groupApi.reducer,
		[userApi.reducerPath]: userApi.reducer,
        [eventApi.reducerPath]: eventApi.reducer,
	},
	middleware: (getDefaultMiddleware) =>
		getDefaultMiddleware().concat(
			loginApi.middleware,
			matterApi.middleware,
			roomApi.middleware,
			groupApi.middleware,
			userApi.middleware,
            eventApi.middleware,
		),
});

export type RootState = ReturnType<typeof store.getState>;
export type AppDispatch = typeof store.dispatch;

export default store;
