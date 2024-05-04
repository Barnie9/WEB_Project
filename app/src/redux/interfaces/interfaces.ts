export interface IResponse {
	code: number;
	status: string;
	message: any;
}

export interface IError {
	status: number;
	data: IResponse;
}

export interface User {
	id: number;
	email: string;
	password: string;
	first_name: string;
	last_name: string;
	type: string;
}
