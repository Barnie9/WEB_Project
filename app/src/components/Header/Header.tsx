import { useNavigate } from "react-router-dom";
import HeaderCSS from "./Header.module.css";

const Header = (props: { type: string }) => {
	const navigate = useNavigate();

	return (
		<div className={HeaderCSS.header}>
			<div className={HeaderCSS.headerTitle}>
				{props.type[0].toUpperCase() + props.type.slice(1) + "s"}
			</div>
			<div
				className={HeaderCSS.button}
				onClick={() => {
					navigate("/" + props.type + "/0");
				}}
			>
				{"Add " + props.type}
			</div>
		</div>
	);
};

export default Header;
