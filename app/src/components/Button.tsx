import { useState } from "react";

type Props = {
	text: string;
	textColor: string;
	backgroundColor: string;
	hoverBackgroundColor: string;
	onClick: () => void;
};

const Button = (props: Props) => {
	const [isHovered, setIsHovered] = useState(false);

	const handleMouseEnter = () => {
		setIsHovered(true);
	};

	const handleMouseLeave = () => {
		setIsHovered(false);
	};

	return (
		<div
			onClick={props.onClick}
			onMouseEnter={handleMouseEnter}
			onMouseLeave={handleMouseLeave}
			style={{
				display: "flex",
				justifyContent: "center",
				alignItems: "center",
				height: "40px",
				backgroundColor: `var(${
					isHovered
						? props.hoverBackgroundColor
						: props.backgroundColor
				})`,
				color: `var(${props.textColor})`,
				padding: "0 10px",
				border: `1px solid var(${props.textColor})`,
				borderRadius: "5px",
				cursor: "pointer",
			}}
		>
			{props.text}
		</div>
	);
};

export default Button;
