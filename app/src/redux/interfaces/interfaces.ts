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
export interface Room {
	id: number;
	name: string;
}
export interface Group {
	id: number;
	programme: string;
	number: number;
	type: string;
}
export interface Event {
    id: number;
    matter_id: number;
    teacher_id: number;
    group_id: number;
    room_id: number;
    start_time: Date;
    end_time: Date;
    type: string;
}