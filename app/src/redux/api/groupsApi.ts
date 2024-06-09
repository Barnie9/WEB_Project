import { createApi, fetchBaseQuery } from '@reduxjs/toolkit/query/react';
import { Group } from '../interfaces/interfaces';

export const groupsApi = createApi({
    reducerPath: 'groupsApi',
    baseQuery: fetchBaseQuery({ baseUrl: 'http://localhost/web_project/src/' }),
    tagTypes: ['Group', 'Groups'],
    endpoints: (builder) => ({
        getAllGroups: builder.query<Group[], void>({
            query: () => 'groups',
            providesTags: ['Groups'],
        }),
        getGroupById: builder.query<Group, number>({
            query: (id) => `groups/${id}`,
            providesTags: ['Group'],
        }),
        addGroup: builder.mutation<Group, Partial<Group>>({
            query: (body) => ({
                url: 'groups',
                method: 'POST',
                body,
            }),
            invalidatesTags: ['Groups'],
        }),
        updateGroup: builder.mutation<Group, Partial<Group>>({
            query: (body) => ({
                url: `groups/${body.id}`,
                method: 'PUT',
                body,
            }),
            invalidatesTags: ['Group', 'Groups'],
        }),
        deleteGroup: builder.mutation<{ success: boolean; id: number }, number>({
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
} = groupsApi;
