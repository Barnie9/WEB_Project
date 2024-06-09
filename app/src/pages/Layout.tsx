import Navbar from "../components/Navbar";
import Sidebar from "../components/Sidebar";
import WeekCalendar from "../components/WeekCalendar";

export const Layout = () => {
	return (
		<div
			style={{
				display: "flex",
				flexDirection: "column",
			}}
		>
			<div
				style={{
					height: "50px",
					width: "100%",
				}}
			>
				<Navbar />
			</div>

			<div
				style={{
					display: "flex",
				}}
			>
				<div
					style={{
						height: "calc(100vh - 50px)",
						width: "20%",
					}}
				>
					<Sidebar />
				</div>

				<div
					style={{
						height: "calc(100vh - 50px)",
						width: "80%",
					}}
				>
					<WeekCalendar />
				</div>
			</div>
		</div>
	);
};
