import { createApi, fetchBaseQuery } from "@reduxjs/toolkit/query/react";
import { IResponse } from "../interfaces/interfaces";

// Define a service using a base URL and expected endpoints
export const loginApi = createApi({
	reducerPath: "loginApi",
	baseQuery: fetchBaseQuery({ baseUrl: "http://localhost/web_project/src/" }),
	endpoints: (builder) => ({
		login: builder.mutation<IResponse, {email: string, password: string}>({
			query: (body) => ({
				url: "login",
				method: "POST",
				body,
			}),
		}),
	}),
});

export const { useLoginMutation } = loginApi;
