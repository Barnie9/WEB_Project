import { useNavigate } from "react-router-dom";
import { Event } from "../../redux/interfaces/interfaces";
import EventCardCSS from "./EventCard.module.css";
import { useGetMatterByIdQuery } from "../../redux/api/matterApi";
import { useGetUserByIdQuery } from "../../redux/api/userApi";
import { useGetGroupByIdQuery } from "../../redux/api/groupApi";
import { useGetRoomByIdQuery } from "../../redux/api/roomApi";

const EventCard = (props: { event: Event }) => {
    const navigate = useNavigate();

    const { data: matter } = useGetMatterByIdQuery(props.event.matter_id);
    const { data: teacher } = useGetUserByIdQuery(props.event.teacher_id);
    const { data: group } = useGetGroupByIdQuery(props.event.group_id);
    const { data: room } = useGetRoomByIdQuery(props.event.room_id);

    return (
        <div className={EventCardCSS.card}
            onClick={() => {
                navigate("/event/" + props.event.id);
            }}
        >
            <div className={EventCardCSS.details}>
                <div>Matter: {matter?.message.title}</div>
                <div>Teacher: {teacher?.message.lastName + " " + teacher?.message.firstName}</div>
                <div>Group: {group?.message.type + " " + group?.message.number}</div>
                <div>Room: {room?.message.name}</div>
                <div>Start Time: {props.event.start_time.toString()}</div>
                <div>End Time: {props.event.end_time.toString()}</div>
                <div>Type: {props.event.type}</div>
            </div>
        </div>
    );
};

export default EventCard;
