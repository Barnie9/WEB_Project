import { useNavigate } from "react-router-dom";
import { Room } from "../../redux/interfaces/interfaces";
import RoomCardCSS from "./RoomCard.module.css";

const RoomCard = (props: { room: Room }) => {
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
