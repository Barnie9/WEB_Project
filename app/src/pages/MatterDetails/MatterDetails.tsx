import { useNavigate, useParams } from "react-router-dom";
import MatterDetailsCSS from "./MatterDetails.module.css";
import {
	useAddMatterMutation,
	useDeleteMatterMutation,
	useGetMatterByIdQuery,
	useUpdateMatterMutation,
} from "../../redux/api/matterApi";
import { IError, Matter } from "../../redux/interfaces/interfaces";
import { useEffect, useState } from "react";

const MatterDetails = () => {
	const params = useParams();
	const navigate = useNavigate();

	const [matter, setMatter] = useState<Matter>({
		id: 0,
		title: "",
		type: "",
	});

	const {
		data: matterData,
		isLoading: matterLoading,
		isFetching: matterFetching,
	} = useGetMatterByIdQuery(Number(params.id));

	const [
		addMatter,
		{ error: addMatterError, isLoading: addMatterIsLoading },
	] = useAddMatterMutation();

	const [
		updateMatter,
		{ error: updateMatterError, isLoading: updateMatterIsLoading },
	] = useUpdateMatterMutation();

	const [
		deleteMatter,
		{ error: deleteMatterError, isLoading: deleteMatterIsLoading },
	] = useDeleteMatterMutation();

	const setMatterTitle = (title: string) => {
		setMatter({ ...matter, title: title });
	};

	const setMatterType = (type: string) => {
		setMatter({ ...matter, type: type });
	};

	useEffect(() => {
		if (matterData) {
			setMatter(matterData.message);
		}
	}, [matterLoading, matterFetching]);

	useEffect(() => {
		if (addMatterError) {
			const error = addMatterError as IError;
			alert(error.data.message);
		}
		if (updateMatterError) {
			const error = updateMatterError as IError;
			alert(error.data.message);
		}
		if (deleteMatterError) {
			const error = deleteMatterError as IError;
			alert(error.data.message);
		}
	}, [addMatterIsLoading, updateMatterIsLoading, deleteMatterIsLoading]);

	return (
		<div className={MatterDetailsCSS.page}>
			<div className={MatterDetailsCSS.form}>
				<input
					type="text"
					placeholder="Title"
					value={matter.title}
					onChange={(e) => {
						setMatterTitle(e.target.value);
					}}
					className={MatterDetailsCSS.input}
				/>
				<select
					value={matter.type}
					onChange={(e) => {
						setMatterType(e.target.value);
					}}
					className={MatterDetailsCSS.select}
				>
					<option value={"mandatory"}>Mandatory</option>
					<option value={"optional"}>Optional</option>
					<option value={"elective"}>Elective</option>
				</select>
			</div>

			<div className={MatterDetailsCSS.footer}>
				{matter.id === 0 ? (
					<div
						className={MatterDetailsCSS.button}
						style={{ backgroundColor: "green" }}
						onClick={() => {
							addMatter(matter);
						}}
					>
						Add
					</div>
				) : (
					<>
						<div
							className={MatterDetailsCSS.button}
							style={{ backgroundColor: "blue" }}
							onClick={() => {
								updateMatter(matter);
							}}
						>
							Update
						</div>
						<div
							className={MatterDetailsCSS.button}
							style={{ backgroundColor: "red" }}
							onClick={() => {
								deleteMatter(matter);
							}}
						>
							Delete
						</div>
					</>
				)}
			</div>
		</div>
	);
};

export default MatterDetails;
