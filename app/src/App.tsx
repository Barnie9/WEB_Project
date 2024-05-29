import { BrowserRouter, Route, Routes } from "react-router-dom";
import Login from "./pages/Login/Login";
import { useAppSelector } from "./redux/hooks";
import { selectUser } from "./redux/slices/userSlice";
import Layout from "./pages/Layout/Layout";
import Matters from "./pages/Matters/Matters";
import MatterDetails from "./pages/MatterDetails/MatterDetails";
import PageNotFound from "./pages/PageNotFound/PageNotFound";

const DefaultRoutes = () => {
	return (
		<BrowserRouter>
			<Routes>
				<Route path="/" element={<Login />} />
				<Route path="*" element={<PageNotFound />} />
			</Routes>
		</BrowserRouter>
	);
};

const AdminRoutes = () => {
	return (
		<BrowserRouter>
			<Routes>
				<Route path="/" element={<Layout />}>
					<Route index element={<div>Admin Dashboard</div>} />
					<Route path="matters" element={<Matters />} />
					<Route path="matter/:id" element={<MatterDetails />} />
				</Route>
				<Route path="*" element={<PageNotFound />} />
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
