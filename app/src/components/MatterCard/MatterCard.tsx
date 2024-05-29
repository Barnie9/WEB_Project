import { useNavigate } from "react-router-dom";
import { Matter } from "../../redux/interfaces/interfaces";
import MatterCardCSS from "./MatterCard.module.css";

const MatterCard = (props: { matter: Matter }) => {
    const navigate = useNavigate();

	return (
		<div className={MatterCardCSS.card}
            onClick={() => {
                navigate("/matter/" + props.matter.id);
            }}
        >
			<div className={MatterCardCSS.title}>{props.matter.title}</div>
			<div className={MatterCardCSS.type}>
				{props.matter.type}
			</div>
		</div>
	);
};

export default MatterCard;
