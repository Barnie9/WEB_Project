// Events.tsx

import { useEffect, useState } from "react";
import { useGetAllEventsQuery } from "../../redux/api/eventApi";
import { Event } from "../../redux/interfaces/interfaces";
import EventsCSS from "./Events.module.css";
import Header from "../../components/Header/Header";
import EventCard from "../../components/EventCard/EventCard";

const Events = () => {
    const [events, setEvents] = useState<Event[]>([]);

    const {
        data: eventsData,
        isLoading: eventsLoading,
        isFetching: eventsFetching,
    } = useGetAllEventsQuery();

    useEffect(() => {
        if (eventsData) {
            setEvents(eventsData.message);
        }
    }, [eventsData, eventsLoading, eventsFetching]);

    return (
        <div className={EventsCSS.page}>
            <Header type="event" />
            <div className={EventsCSS.events}>
                {events.map((event, index) => (
                    <EventCard key={"event-" + index} event={event} />
                ))}
            </div>
        </div>
    );
};

export default Events;
