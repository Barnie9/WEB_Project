import { useEffect, useState } from "react";
import { useGetAllGroupsQuery } from "../../redux/api/groupsApi";
import { Group } from "../../redux/interfaces/interfaces";
import GroupsCSS from "./Groups.module.css";
import Header from "../../components/Header/Header";
import GroupCard from "../../components/GroupCard/GroupCard";

const Groups = () => {
    const [groups, setGroups] = useState<Group[]>([]);

    const {
        data: groupsData,
        isLoading: groupsLoading,
        isFetching: groupsFetching,
        error: groupsError,
    } = useGetAllGroupsQuery();

    useEffect(() => {
        console.log("groupsData:", groupsData); // Log the data received from the API
        if (groupsData && Array.isArray(groupsData.message)) {
            setGroups(groupsData.message);
        }
    }, [groupsData, groupsLoading, groupsFetching]);

    if (groupsLoading || groupsFetching) {
        return <div>Loading...</div>;
    }

    if (groupsError) {
        console.error("Failed to load groups:", groupsError);
        return <div>Error loading groups</div>;
    }

    return (
        <div className={GroupsCSS.page}>
            <Header type="group" />
            <div className={GroupsCSS.groups}>
                {groups.length > 0 ? (
                    groups.map((group, index) => (
                        <GroupCard key={`group-${index}`} group={group} />
                    ))
                ) : (
                    <div>No groups available</div>
                )}
            </div>
        </div>
    );
};

export default Groups;
