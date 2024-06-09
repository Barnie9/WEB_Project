import { useNavigate } from "react-router-dom";
import { Rooms } from "../../redux/interfaces/interfaces";
import RoomCardCSS from "./RoomCard.module.css";

const RoomCard = (props: { room: Rooms }) => {
    const navigate = useNavigate();

    return (
        <div className={RoomCardCSS.card}
            onClick={() => {
                navigate("/room/" + props.room.id);
            }}
        >
            <div className={RoomCardCSS.name}>{props.room.name}</div>
        </div>
    );
};

export default RoomCard;
