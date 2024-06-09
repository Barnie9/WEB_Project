import { createApi, fetchBaseQuery } from "@reduxjs/toolkit/query/react";
import { IResponse, Room } from "../interfaces/interfaces";

export const roomApi = createApi({
    reducerPath: "roomApi",
    baseQuery: fetchBaseQuery({ baseUrl: "http://localhost/web_project/src/" }),
    tagTypes: ["Room", "Rooms"],
    endpoints: (builder) => ({
        getAllRooms: builder.query<IResponse, void>({
            query: () => "rooms",
            providesTags: ["Rooms"],
        }),
        getRoomById: builder.query<IResponse, number>({
            query: (id) => `rooms/${id}`,
            providesTags: ["Room"],
        }),
        addRoom: builder.mutation<IResponse, Partial<Room>>({
            query: (body) => ({
                url: `rooms`,
                method: "POST",
                body,
            }),
            invalidatesTags: ["Rooms"],
        }),
        updateRoom: builder.mutation<IResponse, Room>({
            query: (body) => ({
                url: `rooms/${body.id}`,
                method: "PUT",
                body,
            }),
            invalidatesTags: ["Room", "Rooms"],
        }),
        deleteRoom: builder.mutation<IResponse, number>({
            query: (id) => ({
                url: `rooms/${id}`,
                method: "DELETE",
            }),
            invalidatesTags: ["Rooms"],
        }),
    }),
});

export const {
    useGetAllRoomsQuery,
    useGetRoomByIdQuery,
    useAddRoomMutation,
    useUpdateRoomMutation,
    useDeleteRoomMutation,
} = roomApi;
