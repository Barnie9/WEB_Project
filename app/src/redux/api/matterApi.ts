import { createApi, fetchBaseQuery } from "@reduxjs/toolkit/query/react";
import { IResponse, Matter } from "../interfaces/interfaces";

export const matterApi = createApi({
	reducerPath: "matterApi",
	baseQuery: fetchBaseQuery({ baseUrl: "http://localhost/web_project/src/" }),
	tagTypes: ["Matter", "Matters"],
	endpoints: (builder) => ({
		getAllMatters: builder.query<IResponse, void>({
			query: () => "matters",
			providesTags: ["Matters"],
		}),
		getMatterById: builder.query<IResponse, number>({
			query: (id) => `matters/${id}`,
			providesTags: ["Matter"],
		}),
		addMatter: builder.mutation<IResponse, Partial<Matter>>({
			query: (body) => ({
				url: `matters`,
				method: "POST",
				body,
			}),
			invalidatesTags: ["Matters"],
		}),
		updateMatter: builder.mutation<IResponse, Matter>({
			query: (body) => ({
				url: `matters/${body.id}`,
				method: "PUT",
				body,
			}),
			invalidatesTags: ["Matter", "Matters"],
		}),
		deleteMatter: builder.mutation<IResponse, number>({
			query: (id) => ({
				url: `matters/${id}`,
				method: "DELETE",
			}),
			invalidatesTags: ["Matters"],
		}),
	}),
});

export const {
	useGetAllMattersQuery,
	useGetMatterByIdQuery,
	useAddMatterMutation,
	useUpdateMatterMutation,
	useDeleteMatterMutation,
} = matterApi;
