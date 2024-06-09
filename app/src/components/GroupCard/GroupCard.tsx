import { useNavigate } from "react-router-dom";
import { Group } from "../../redux/interfaces/interfaces";
import GroupCardCSS from "./GroupCard.module.css";

const GroupCard = (props: { group: Group }) => {
    const navigate = useNavigate();

    return (
        <div className={GroupCardCSS.card}
            onClick={() => {
                navigate("/group/" + props.group.id);
            }}
        >
            <div className={GroupCardCSS.programme}>{props.group.programme}</div>
            <div className={GroupCardCSS.number}>{props.group.number}</div>
            <div className={GroupCardCSS.type}>{props.group.type}</div>
        </div>
    );
};

export default GroupCard;
