import { useNavigate, useParams } from "react-router-dom";
import GroupDetailsCSS from "./GroupsDetails.module.css";
import {
    useAddGroupMutation,
    useDeleteGroupMutation,
    useGetGroupByIdQuery,
    useUpdateGroupMutation,
} from "../../redux/api/groupsApi";
import { Group } from "../../redux/interfaces/interfaces";
import { useEffect, useState } from "react";
import { useErrorEffect } from "../../customEffects";

const GroupDetails = () => {
    const params = useParams();
    const navigate = useNavigate();

    const [group, setGroup] = useState<Group>({
        id: 0,
        programme: "",
        number: 0,
        type: "",
    });

    const {
        data: groupData,
        isLoading: groupLoading,
        isFetching: groupFetching,
    } = useGetGroupByIdQuery(Number(params.id), {
        skip: params.id === "0",
    });

    const [
        addGroup,
        { error: addGroupError, isSuccess: addGroupIsSuccess },
    ] = useAddGroupMutation();

    const [
        updateGroup,
        { error: updateGroupError, isSuccess: updateGroupIsSuccess },
    ] = useUpdateGroupMutation();

    const [
        deleteGroup,
        { error: deleteGroupError, isSuccess: deleteGroupIsSuccess },
    ] = useDeleteGroupMutation();

    const setGroupProgramme = (programme: string) => {
        setGroup({ ...group, programme });
    };

    const setGroupNumber = (number: number) => {
        setGroup({ ...group, number });
    };

    const setGroupType = (type: string) => {
        setGroup({ ...group, type });
    };

    useEffect(() => {
        if (groupData && groupData.message) {
            setGroup(groupData.message);
        }
    }, [groupData, groupLoading, groupFetching]);

    useErrorEffect(addGroupError);
    useErrorEffect(updateGroupError);
    useErrorEffect(deleteGroupError);

    useEffect(() => {
        if (addGroupIsSuccess || updateGroupIsSuccess || deleteGroupIsSuccess) {
            navigate("/groups");
        }
    }, [addGroupIsSuccess, updateGroupIsSuccess, deleteGroupIsSuccess]);

    return (
        <div className={GroupDetailsCSS.page}>
            <div className={GroupDetailsCSS.form}>
                <input
                    type="text"
                    placeholder="Programme"
                    value={group.programme}
                    onChange={(e) => {
                        setGroupProgramme(e.target.value);
                    }}
                    className={GroupDetailsCSS.input}
                />
                <input
                    type="number"
                    placeholder="Number"
                    value={group.number}
                    onChange={(e) => {
                        setGroupNumber(Number(e.target.value));
                    }}
                    className={GroupDetailsCSS.input}
                />
                <select
                    value={group.type}
                    onChange={(e) => {
                        setGroupType(e.target.value);
                    }}
                    className={GroupDetailsCSS.select}
                >
                    <option value={"year"}>Year</option>
                    <option value={"group"}>Group</option>
                    <option value={"subgroup"}>Subgroup</option>
                </select>
            </div>

            <div className={GroupDetailsCSS.footer}>
                {group.id === 0 ? (
                    <div
                        className={GroupDetailsCSS.button}
                        style={{ backgroundColor: "green" }}
                        onClick={() => {
                            addGroup(group);
                        }}
                    >
                        Add
                    </div>
                ) : (
                    <>
                        <div
                            className={GroupDetailsCSS.button}
                            style={{ backgroundColor: "blue" }}
                            onClick={() => {
                                updateGroup(group);
                            }}
                        >
                            Update
                        </div>
                        <div
                            className={GroupDetailsCSS.button}
                            style={{ backgroundColor: "red" }}
                            onClick={() => {
                                deleteGroup(group.id);
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

export default GroupDetails;
