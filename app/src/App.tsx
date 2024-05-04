import { BrowserRouter, Route, Routes } from "react-router-dom";
import Login from "./pages/Login/Login";
import { useAppSelector } from "./redux/hooks";
import { selectUser } from "./redux/slices/userSlice";

const DefaultRoutes = () => {
	return (
		<BrowserRouter>
			<Routes>
				<Route path="/" element={<Login />} />
			</Routes>
		</BrowserRouter>
	);
};

const AdminRoutes = () => {
	return (
		<BrowserRouter>
			<Routes>
				<Route path="/login" element={<Login />} />
			</Routes>
		</BrowserRouter>
	);
};

const App = () => {
	const user = useAppSelector(selectUser);

	if (!user) {
		return <DefaultRoutes />;
	}
	if (user.type === "admin") {
		return <AdminRoutes />;
	}
};

export default App;
