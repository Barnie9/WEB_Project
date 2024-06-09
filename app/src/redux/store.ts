import { configureStore } from "@reduxjs/toolkit";
import userSlice from "./slices/userSlice";
import loginSlice from "./slices/loginSlice";
import { loginApi } from "./api/loginApi";
import { matterApi } from "./api/matterApi";
import { roomApi } from "./api/roomsApi";
import { groupsApi } from "./api/groupsApi";
import { usersApi } from "./api/usersApi";


export const store = configureStore({
    reducer: {
        loginReducer: loginSlice,
        userReducer: userSlice,
        [loginApi.reducerPath]: loginApi.reducer,
        [matterApi.reducerPath]: matterApi.reducer,
        [roomApi.reducerPath]: roomApi.reducer,
        [groupsApi.reducerPath]: groupsApi.reducer,
        [usersApi.reducerPath]: usersApi.reducer,
    },
    middleware: (getDefaultMiddleware) =>
        getDefaultMiddleware().concat(
            loginApi.middleware,
            matterApi.middleware,
            roomApi.middleware,
            groupsApi.middleware,
            usersApi.middleware

        ),
});

export type RootState = ReturnType<typeof store.getState>;
export type AppDispatch = typeof store.dispatch;

export default store;
