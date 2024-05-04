import { useEffect } from "react";
import { useLoginMutation } from "../../redux/api/loginApi";
import { useAppDispatch, useAppSelector } from "../../redux/hooks";
import {
	clearLoginState,
	selectEmail,
	selectPassword,
	setEmail,
	setPassword,
} from "../../redux/slices/loginSlice";
import LoginCSS from "./Login.module.css";
import { IError } from "../../redux/interfaces/interfaces";
import { setUser } from "../../redux/slices/userSlice";
import { useNavigate } from "react-router-dom";

const Login = () => {
	const navigate = useNavigate();
	const dispatch = useAppDispatch();

	const email = useAppSelector(selectEmail);
	const password = useAppSelector(selectPassword);

	const [login, { data, error, isLoading }] = useLoginMutation();

	const handleLogin = () => {
		login({ email, password });
	};

	useEffect(() => {
		if (error) {
			const loginError = error as IError;
			alert(loginError.data.message);
		} else if (data) {
			dispatch(clearLoginState());
			dispatch(setUser(data.message));
            navigate("/login");
		}
	}, [isLoading]);

	return (
		<div className={LoginCSS.page}>
			<div className={LoginCSS.form}>
				<div className={LoginCSS.title}>Login</div>
				<input
					type="email"
					className={LoginCSS.input}
					placeholder="Email"
					value={email}
					onChange={(e) => {
						dispatch(setEmail(e.target.value));
					}}
				/>
				<input
					type="password"
					className={LoginCSS.input}
					placeholder="Password"
					value={password}
					onChange={(e) => {
						dispatch(setPassword(e.target.value));
					}}
				/>
				<div className={LoginCSS.button} onClick={handleLogin}>
					Login
				</div>
			</div>
		</div>
	);
};

export default Login;
