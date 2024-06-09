import { createApi, fetchBaseQuery } from '@reduxjs/toolkit/query/react';
import { Group, IResponse } from '../interfaces/interfaces';

export const groupApi = createApi({
    reducerPath: 'groupApi',
    baseQuery: fetchBaseQuery({ baseUrl: 'http://localhost/web_project/src/' }),
    tagTypes: ['Group', 'Groups'],
    endpoints: (builder) => ({
        getAllGroups: builder.query<IResponse, void>({
            query: () => 'groups',
            providesTags: ['Groups'],
        }),
        getGroupById: builder.query<IResponse, number>({
            query: (id) => `groups/${id}`,
            providesTags: ['Group'],
        }),
        addGroup: builder.mutation<IResponse, Partial<Group>>({
            query: (body) => ({
                url: 'groups',
                method: 'POST',
                body,
            }),
            invalidatesTags: ['Groups'],
        }),
        updateGroup: builder.mutation<IResponse, Partial<Group>>({
            query: (body) => ({
                url: `groups/${body.id}`,
                method: 'PUT',
                body,
            }),
            invalidatesTags: ['Group', 'Groups'],
        }),
        deleteGroup: builder.mutation<IResponse, number>({
            query: (id) => ({
                url: `groups/${id}`,
                method: 'DELETE',
            }),
            invalidatesTags: ['Groups'],
        }),
    }),
});

export const {
    useGetAllGroupsQuery,
    useGetGroupByIdQuery,
    useAddGroupMutation,
    useUpdateGroupMutation,
    useDeleteGroupMutation,
} = groupApi;
