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
	firstName: string;
	lastName: string;
	type: string;
}

export interface Matter {
	id: number;
	title: string;
	type: string;
}
