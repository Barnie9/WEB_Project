import { createApi, fetchBaseQuery } from "@reduxjs/toolkit/query/react";
import { IResponse, User } from "../interfaces/interfaces";

export const usersApi = createApi({
    reducerPath: "usersApi",
    baseQuery: fetchBaseQuery({ baseUrl: "http://localhost/web_project/src/" }),
    tagTypes: ["User", "Users"],
    endpoints: (builder) => ({
        getAllUsers: builder.query<IResponse, void>({
            query: () => "users",
            providesTags: ["Users"],
        }),
        getUserById: builder.query<IResponse, number>({
            query: (id) => `users/${id}`,
            providesTags: ["User"],
        }),
        addUser: builder.mutation<IResponse, Partial<User>>({
            query: (body) => ({
                url: `users`,
                method: "POST",
                body,
            }),
            invalidatesTags: ["Users"],
        }),
        updateUser: builder.mutation<IResponse, User>({
            query: (body) => ({
                url: `users/${body.id}`,
                method: "PUT",
                body,
            }),
            invalidatesTags: ["User", "Users"],
        }),
        deleteUser: builder.mutation<IResponse, number>({
            query: (id) => ({
                url: `users/${id}`,
                method: "DELETE",
            }),
            invalidatesTags: ["Users"],
        }),
    }),
});

export const {
    useGetAllUsersQuery,
    useGetUserByIdQuery,
    useAddUserMutation,
    useUpdateUserMutation,
    useDeleteUserMutation,
} = usersApi;
