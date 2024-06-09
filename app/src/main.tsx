import ReactDOM from "react-dom/client";
import App from "./App.tsx";
import { Provider } from "react-redux";
import { store } from "./redux/store.ts";
import "./index.css";
import { AdapterDayjs } from "@mui/x-date-pickers/AdapterDayjs";
import { LocalizationProvider } from "@mui/x-date-pickers/LocalizationProvider";

ReactDOM.createRoot(document.getElementById("root")!).render(
	<LocalizationProvider dateAdapter={AdapterDayjs}>
		<Provider store={store}>
			<App />
		</Provider>
	</LocalizationProvider>
);
