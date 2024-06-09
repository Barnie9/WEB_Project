import { useEffect, useState } from "react";
import { useGetAllMattersQuery } from "../../redux/api/matterApi";
import { Matter } from "../../redux/interfaces/interfaces";
import MattersCSS from "./Matters.module.css";
import Header from "../../components/Header/Header";
import MatterCard from "../../components/MatterCard/MatterCard";

const Matters = () => {
	const [matters, setMatters] = useState<Matter[]>([]);

	const {
		data: mattersData,
		isLoading: mattersLoading,
		isFetching: mattersFetching,
	} = useGetAllMattersQuery();

	useEffect(() => {
		if (mattersData) {
			setMatters(mattersData.message);
		}
	}, [mattersLoading, mattersFetching]);

	return (
		<div className={MattersCSS.page}>
			<Header type="matter" />
			<div className={MattersCSS.matters}>
				{matters.map((matter, index) => (
					<MatterCard key={"matter-" + index} matter={matter} />
				))}
			</div>
		</div>
	);
};

export default Matters;
