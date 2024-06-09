import { useNavigate } from "react-router-dom";
import { Event } from "../../redux/interfaces/interfaces";
import EventCardCSS from "./EventCard.module.css";

const EventCard = (props: { event: Event }) => {
    const navigate = useNavigate();

    return (
        <div className={EventCardCSS.card}
            onClick={() => {
                navigate("/event/" + props.event.id);
            }}
        >
            <div className={EventCardCSS.details}>
                <div>Matter ID: {props.event.matter_id}</div>
                <div>Teacher ID: {props.event.teacher_id}</div>
                <div>Group ID: {props.event.group_id}</div>
                <div>Room ID: {props.event.room_id}</div>
                <div>Start Time: {props.event.start_time.toString()}</div>
                <div>End Time: {props.event.end_time.toString()}</div>
                <div>Type: {props.event.type}</div>
            </div>
        </div>
    );
};

export default EventCard;
