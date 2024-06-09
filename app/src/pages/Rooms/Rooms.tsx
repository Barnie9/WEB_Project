import { useEffect, useState } from "react";
import { useGetAllRoomsQuery } from "../../redux/api/roomApi";
import { Room } from "../../redux/interfaces/interfaces";
import RoomsCSS from "./Rooms.module.css";
import Header from "../../components/Header/Header";
import RoomCard from "../../components/RoomCard/RoomCard";

const Rooms = () => {
	const [rooms, setRooms] = useState<Room[]>([]);

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

export default Rooms;
