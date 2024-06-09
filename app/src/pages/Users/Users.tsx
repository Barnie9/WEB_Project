import React, { useEffect, useState } from "react";
import { useGetAllUsersQuery } from "../../redux/api/userApi";
import { User } from "../../redux/interfaces/interfaces";
import UsersCSS from "./Users.module.css";
import Header from "../../components/Header/Header";
import UserCard from "../../components/UserCard/UserCard";

const Users = () => {
	const [users, setUsers] = useState<User[]>([]);

	const {
		data: usersData,
		isLoading: usersLoading,
		isFetching: usersFetching,
		error: usersError,
	} = useGetAllUsersQuery();

	useEffect(() => {
		console.log("usersData:", usersData); // Log the data received from the API
		if (usersData && Array.isArray(usersData.message)) {
			setUsers(usersData.message);
		}
	}, [usersData, usersLoading, usersFetching]);

	if (usersLoading || usersFetching) {
		return <div>Loading...</div>;
	}

	if (usersError) {
		console.error("Failed to load users:", usersError);
		return <div>Error loading users</div>;
	}

	return (
		<div className={UsersCSS.page}>
			<Header type="user" />
			<div className={UsersCSS.users}>
				{users.length > 0 ? (
					users.map((user, index) => (
						<UserCard key={`user-${index}`} user={user} />
					))
				) : (
					<div>No users available</div>
				)}
			</div>
		</div>
	);
};

export default Users;
