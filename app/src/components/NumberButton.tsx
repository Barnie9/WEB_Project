import { useState } from "react";

type Props = {
	number: string;
    textColor: string;
	backgroundColor: string;
	hoverBackgroundColor: string;
	onClick: () => void;
};

const NumberButton = (props: Props) => {
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
				height: "30px",
                width: "30px",
				backgroundColor: `var(${
					isHovered
						? props.hoverBackgroundColor
						: props.backgroundColor
				})`,
				color: `var(${props.textColor})`,
				padding: "10px",
				borderRadius: "50%",
				cursor: "pointer",
			}}
		>
			{props.number}
		</div>
	);
};

export default NumberButton;
