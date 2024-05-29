import { createApi, fetchBaseQuery } from "@reduxjs/toolkit/query/react";
import { IResponse, Matter } from "../interfaces/interfaces";

export const matterApi = createApi({
	reducerPath: "matterApi",
	baseQuery: fetchBaseQuery({ baseUrl: "http://localhost/web_project/src/" }),
	tagTypes: ["Matter"],
	endpoints: (builder) => ({
		getAllMatters: builder.query<IResponse, void>({
			query: () => "matters",
			providesTags: ["Matter"],
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
			invalidatesTags: ["Matter"],
		}),
		updateMatter: builder.mutation<
			IResponse,
			Partial<Matter> & Pick<Matter, "id">
		>({
			query: ({ id, ...body }) => ({
				url: `matters/${id}`,
				method: "PUT",
				body,
			}),
			invalidatesTags: ["Matter"],
		}),
		deleteMatter: builder.mutation<IResponse, Pick<Matter, "id">>({
			query: ({ id }) => ({
				url: `matters/${id}`,
				method: "DELETE",
			}),
			invalidatesTags: ["Matter"],
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
