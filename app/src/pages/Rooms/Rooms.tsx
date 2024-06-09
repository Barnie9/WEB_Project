import { useEffect, useState } from "react";
import { useGetAllRoomsQuery } from "../../redux/api/roomApi";
import { Rooms } from "../../redux/interfaces/interfaces";
import RoomsCSS from "./Rooms.module.css";
import Header from "../../components/Header/Header";
import RoomCard from "../../components/RoomCard/RoomCard";

const Room = () => {
	const [rooms, setRooms] = useState<Rooms[]>([]);

	const {
		data: roomsData,
		isLoading: roomsLoading,
		isFetching: roomsFetching,
	} = useGetAllRoomsQuery();

	useEffect(() => {
		if (roomsData) {
			setRooms(roomsData.message);
		}
	}, [roomsLoading, roomsFetching]);

	return (
		<div className={RoomsCSS.page}>
			<Header type="room" />
			<div className={RoomsCSS.rooms}>
				{rooms.map((room, index) => (
					<RoomCard key={"room-" + index} room={room} />
				))}
			</div>
		</div>
	);
};

export default Room;
