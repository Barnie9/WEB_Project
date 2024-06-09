import { useNavigate, useParams } from "react-router-dom";
import MatterDetailsCSS from "./MatterDetails.module.css";
import {
	useAddMatterMutation,
	useDeleteMatterMutation,
	useGetMatterByIdQuery,
	useUpdateMatterMutation,
} from "../../redux/api/matterApi";
import { Matter } from "../../redux/interfaces/interfaces";
import { useEffect, useState } from "react";
import { useErrorEffect } from "../../customEffects";

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
	} = useGetMatterByIdQuery(Number(params.id), {
		skip: params.id === "0",
	});

	const [
		addMatter,
		{ error: addMatterError, isSuccess: addMatterIsSuccess },
	] = useAddMatterMutation();

	const [
		updateMatter,
		{ error: updateMatterError, isSuccess: updateMatterIsSuccess },
	] = useUpdateMatterMutation();

	const [
		deleteMatter,
		{ error: deleteMatterError, isSuccess: deleteMatterIsSuccess},
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

	useErrorEffect(addMatterError);
	useErrorEffect(updateMatterError);
	useErrorEffect(deleteMatterError);

	useEffect(() => {
		if (addMatterIsSuccess || updateMatterIsSuccess || deleteMatterIsSuccess) {
			navigate("/matters");
		}
	}, [addMatterIsSuccess, updateMatterIsSuccess, deleteMatterIsSuccess]);

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
								deleteMatter(matter.id);
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
