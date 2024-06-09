import { useNavigate } from "react-router-dom";
import { User } from "../../redux/interfaces/interfaces";
import UserCardCSS from "./UsersCard.module.css";

const UserCard = (props: { user: User }) => {
    const navigate = useNavigate();

    return (
        <div className={UserCardCSS.card}
            onClick={() => {
                navigate("/user/" + props.user.id);
            }}
        >
            <div className={UserCardCSS.email}>{props.user.email}</div>
            <div className={UserCardCSS.name}>
                {props.user.firstName} {props.user.lastName}
            </div>
            <div className={UserCardCSS.type}>{props.user.type}</div>
        </div>
    );
};

export default UserCard;
