import { useNavigate, useParams } from "react-router-dom";
import RoomDetailsCSS from "./RoomDetails.module.css";
import {
	useAddRoomMutation,
	useDeleteRoomMutation,
	useGetRoomByIdQuery,
	useUpdateRoomMutation,
} from "../../redux/api/roomApi";
import { Rooms } from "../../redux/interfaces/interfaces";
import { useEffect, useState } from "react";
import { useErrorEffect } from "../../customEffects";

const RoomDetails = () => {
	const params = useParams();
	const navigate = useNavigate();

	const [room, setRoom] = useState<Rooms>({
		id: 0,
		name: "",
	});

	const {
		data: roomData,
		isLoading: roomLoading,
		isFetching: roomFetching,
	} = useGetRoomByIdQuery(Number(params.id), {
		skip: params.id === "0",
	});

	const [addRoom, { error: addRoomError, isSuccess: addRoomIsSuccess }] =
		useAddRoomMutation();

	const [
		updateRoom,
		{ error: updateRoomError, isSuccess: updateRoomIsSuccess },
	] = useUpdateRoomMutation();

	const [
		deleteRoom,
		{ error: deleteRoomError, isSuccess: deleteRoomIsSuccess },
	] = useDeleteRoomMutation();

	const setRoomName = (name: string) => {
		setRoom({ ...room, name: name });
	};

	useEffect(() => {
		if (roomData) {
			setRoom(roomData.message);
		}
	}, [roomLoading, roomFetching]);

	useErrorEffect(addRoomError);
	useErrorEffect(updateRoomError);
	useErrorEffect(deleteRoomError);

	useEffect(() => {
		if (addRoomIsSuccess || updateRoomIsSuccess || deleteRoomIsSuccess) {
			navigate("/rooms");
		}
	}, [addRoomIsSuccess, updateRoomIsSuccess, deleteRoomIsSuccess]);

	return (
		<div className={RoomDetailsCSS.page}>
			<div className={RoomDetailsCSS.form}>
				<input
					type="text"
					placeholder="Name"
					value={room.name}
					onChange={(e) => {
						setRoomName(e.target.value);
					}}
					className={RoomDetailsCSS.input}
				/>
			</div>

			<div className={RoomDetailsCSS.footer}>
				{room.id === 0 ? (
					<div
						className={RoomDetailsCSS.button}
						style={{ backgroundColor: "green" }}
						onClick={() => {
							addRoom(room);
						}}
					>
						Add
					</div>
				) : (
					<>
						<div
							className={RoomDetailsCSS.button}
							style={{ backgroundColor: "blue" }}
							onClick={() => {
								updateRoom(room);
							}}
						>
							Update
						</div>
						<div
							className={RoomDetailsCSS.button}
							style={{ backgroundColor: "red" }}
							onClick={() => {
								deleteRoom(room.id);
							}}
						>
							Delete
						</div>
					</>
				)}
			</div>
		</div>
	);
};

export default RoomDetails;
