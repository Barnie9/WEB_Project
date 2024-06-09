import Button from "./Button";
import {
	IconChevronLeft,
	IconChevronRight,
	IconLogout,
} from "@tabler/icons-react";
import IconButton from "./IconButton";
import { useAppDispatch, useAppSelector } from "../redux/hooks";
import {
	selectCurrentSelectedDate,
	setCurrentSelectedDate,
} from "../redux/slices/dateSlice";
import dayjs from "dayjs";
import {
	getSundayFromNextWeek,
	getSundayFromPastWeek,
} from "../utils";
import { clearUser, selectUser } from "../redux/slices/userSlice";
import { useNavigate } from "react-router-dom";

const Navbar = () => {
	const navigate = useNavigate();
	const dispatch = useAppDispatch();

	const currentSelectedDate = useAppSelector(selectCurrentSelectedDate);

	const user = useAppSelector(selectUser);

	const logout = () => {
		dispatch(clearUser());
		navigate("/");
	};

	return (
		<div
			style={{
				display: "flex",
				height: "100%",
				width: "calc(100% - 20px)",
				padding: "0 10px",
				borderBottom: "1px solid var(--light-gray)",
			}}
		>
			<div
				style={{
					display: "flex",
					justifyContent: "center",
					alignItems: "center",
					height: "100%",
					width: "60%",
					gap: "10px",
				}}
			>
				<IconButton
					onClick={() =>
						dispatch(
							setCurrentSelectedDate(
								getSundayFromPastWeek(currentSelectedDate)
							)
						)
					}
				>
					<IconChevronLeft stroke={2} />
				</IconButton>
				<IconButton
					onClick={() =>
						dispatch(
							setCurrentSelectedDate(
								getSundayFromNextWeek(currentSelectedDate)
							)
						)
					}
				>
					<IconChevronRight stroke={2} />
				</IconButton>
				<Button
					text="TODAY"
					textColor="--red-primary"
					backgroundColor="--white"
					hoverBackgroundColor="--light-gray"
					onClick={() => dispatch(setCurrentSelectedDate(dayjs()))}
				/>
			</div>

			<div
				style={{
					display: "flex",
					justifyContent: "flex-end",
					alignItems: "center",
					height: "100%",
					width: "40%",
					gap: "10px",
				}}
			>
				<div
					style={{
						color: "var(--gray)",
						fontSize: "1.5rem",
					}}
				>
					{user?.firstName + " " + user?.lastName}
				</div>
				<IconButton onClick={logout}>
					<IconLogout stroke={2} />
				</IconButton>
			</div>
		</div>
	);
};

export default Navbar;
