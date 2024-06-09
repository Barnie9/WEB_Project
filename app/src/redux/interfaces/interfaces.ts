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
export interface Rooms {
	id: number;
	name: string;

}
export interface Group {
	id: number;
	programme: string;
	number: number;
	type: string;
}

export interface Users{
    id: number;
    email: string;
    password: string;
    first_name: string;
    last_name: string;
    type: string;

}    