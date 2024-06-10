// eventApi.ts

import { createApi, fetchBaseQuery } from "@reduxjs/toolkit/query/react";
import { Event, IResponse } from "../interfaces/interfaces";

export const eventApi = createApi({
	reducerPath: "eventApi",
	baseQuery: fetchBaseQuery({ baseUrl: "http://localhost/web_project/src/" }),
	tagTypes: ["Event", "Events"],
	endpoints: (builder) => ({
		getAllEvents: builder.query<IResponse, void>({
			query: () => "events",
			providesTags: ["Events"],
		}),
		getEventById: builder.query<IResponse, number>({
			query: (id) => `events/${id}`,
			providesTags: ["Event"],
		}),
		addEvent: builder.mutation<IResponse, Partial<Event>>({
			query: (body) => ({
				url: "events",
				method: "POST",
				body,
			}),
			invalidatesTags: ["Events"],
		}),
		updateEvent: builder.mutation<IResponse, Partial<Event>>({
			query: (body) => ({
				url: `events/${body.id}`,
				method: "PUT",
				body,
			}),
			invalidatesTags: ["Event", "Events"],
		}),
		deleteEvent: builder.mutation<IResponse, number>({
			query: (id) => ({
				url: `events/${id}`,
				method: "DELETE",
			}),
			invalidatesTags: ["Events"],
		}),
		getFilteredEvents: builder.mutation<IResponse, { groupIds: number[]; startDate: Date; endDate: Date }>({
			query: ({ groupIds, startDate, endDate }) => ({
				url: `events/filtered`,
				method: "POST",
				body: { groupIds, startDate, endDate },
			}),
			providesTags: ["Events"],
		}),
	}),
});

export const {
	useGetAllEventsQuery,
	useGetEventByIdQuery,
	useAddEventMutation,
	useUpdateEventMutation,
	useDeleteEventMutation,
	useGetFilteredEventsMutation,
} = eventApi;
