import SidebarCSS from "./Sidebar.module.css";
import UserIcon from "../../assets/UserIcon.png";
import { useAppDispatch, useAppSelector } from "../../redux/hooks";
import { clearUser, selectUser } from "../../redux/slices/userSlice";
import { Article, MeetingRoom, Groups, Person, Event, Logout } from "@mui/icons-material";
import { useNavigate } from "react-router-dom";

const Sidebar = () => {
    const navigate = useNavigate();
	const dispatch = useAppDispatch();

	const user = useAppSelector(selectUser);

	const logout = () => {
		dispatch(clearUser());
		navigate("/");
	};

	return (
		<div className={SidebarCSS.sidebar}>
			<div className={SidebarCSS.userDetails}>
				<img
					src={UserIcon}
					alt="User Icon"
					className={SidebarCSS.userIcon}
				/>
				<div className={SidebarCSS.username}>
					{user!.firstName} {user!.lastName}
				</div>
				<div className={SidebarCSS.email}>{user!.email}</div>
			</div>
			<div className={SidebarCSS.menu}>
				<div className={SidebarCSS.menuItem} onClick={() => {
                    navigate("/matters");
                }}>
					<Article className={SidebarCSS.menuItemIcon} />
					Matters
				</div>
				<div className={SidebarCSS.menuItem} onClick={() =>{
					navigate("/rooms")
				
				}}>
					<MeetingRoom className={SidebarCSS.menuItemIcon} />
					Rooms
				</div>
                <div className={SidebarCSS.menuItem} onClick={() =>{
					navigate("/groups")
				}}>
					<Groups className={SidebarCSS.menuItemIcon} />
					Groups
				</div>
                <div className={SidebarCSS.menuItem} onClick={() =>
					navigate("/users")
				}>
					<Person className={SidebarCSS.menuItemIcon} />
					Users
				</div>
                <div className={SidebarCSS.menuItem}>
					<Event className={SidebarCSS.menuItemIcon} />
					Events
				</div>
			</div>
			<div className={SidebarCSS.menuItem} onClick={logout}>
				<Logout className={SidebarCSS.menuItemIcon} />
				Logout
			</div>
		</div>
	);
};

export default Sidebar;
