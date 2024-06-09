import { SerializedError } from "@reduxjs/toolkit";
import { FetchBaseQueryError } from "@reduxjs/toolkit/query";
import { useEffect } from "react";
import { IError } from "./redux/interfaces/interfaces";

export const useErrorEffect = (
	apiError: FetchBaseQueryError | SerializedError | undefined
) => {
	useEffect(() => {
		if (apiError) {
			const error = apiError as IError;
			alert(error.data.message);
			return;
		}
	}, [apiError]);
};
