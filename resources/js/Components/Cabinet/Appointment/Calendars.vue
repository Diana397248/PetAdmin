<template>
    <div>
        <div class="d-flex justify-end ">
            <v-btn
                @click="routeToAddAppointment"
                class="p-2" color="rgb(255, 197, 158)">Записаться</v-btn>
        </div>
        <v-calendar
            ref="calendar"
            v-model="value"
            :events="events"
            view-mode="month"
            :weekdays="[  2, 3, 4, 5, 6, 0, 1]"
            hide-week-number="false"

            @click="goToAppointmentForm"
            style="min-width: 60%"
        >
            <template v-slot:event="obj">
                <div class="m-3 d-flex flex-column w-full" style="min-width: 100px">
                    <v-chip :color="obj.event.color" class="appoint-chip d-flex justify-content-center">
                        {{ obj.event.title && "           " }} {{
                            new Date(obj.event.start).toLocaleTimeString([], {
                                hour: '2-digit',
                                minute: '2-digit'
                            })
                        }}
                    </v-chip>
                </div>
            </template>
        </v-calendar>
    </div>
</template>

<script setup>
import {useDate} from 'vuetify'
import {onMounted, reactive, ref} from "vue";
import {VCalendar} from 'vuetify/labs/VCalendar'
import {router} from "@inertiajs/vue3";


onMounted(() => {
    fetchAllAppointments()
    const adapter = useDate()
    // getEvents({
    //   start: adapter.startOfDay(adapter.startOfMonth(new Date())),
    //   end: adapter.endOfDay(adapter.endOfMonth(new Date()))
    // })
})


const types = reactive(['month', 'week', 'day'])
const value = ref([new Date()])

const routeToAddAppointment = ()=> {
    router.get(route('cabinet.addAppointment'));
}

const fetchAllAppointments = async () => {
    const response = await axios.get('/appointments/fetchAllAppointments?all');
    events.value = response.data.map((appointment) => {
        let end = new Date(appointment.start_time);
        return ({
            id: appointment.id,
            title: " ",
            start: new Date(appointment.start_time),
            end: end,
            description: appointment.description,
            color: getRandomColor(),
            allDay: false

            // todo client
        })
    });
};

function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

const events = ref([]);
// const events = ref([{
//     "title": "Операция",
//     "start": new Date("2024-05-06T15:15:00.000Z"),
//     "end": new Date("2024-05-06T19:15:00.000Z"),
//     "color": "blue",
//     "allDay": true
// }, {
//     "title": "Повторный прием",
//     "start": new Date("2024-05-26T08:35:00.000Z"),
//     "end": new Date("2024-05-26T08:45:00.000Z"),
//     "color": "indigo",
//     "allDay": false
// }, {
//     "title": "Укол",
//     "start": new Date("2024-05-12T06:30:00.000Z"),
//     "end": new Date("2024-05-12T06:30:00.000Z"),
//     "color": "grey darken-1",
//     "allDay": false
// }, {
//     "title": "Осмотр",
//     "start": new Date("2024-05-02T08:45:00.000Z"),
//     "end": new Date("2024-05-02T08:45:00.000Z"),
//     "color": "indigo",
//     "allDay": true
// }, {
//     "title": "Укол от бешенства",
//     "start": new Date("2024-05-22T10:15:00.000Z"),
//     "end": new Date("2024-05-22T10:15:00.000Z"),
//     "color": "orange",
//     "allDay": false
// }, {
//     "title": "Консультация",
//     "start": new Date("2024-05-13T14:30:00.000Z"),
//     "end": new Date("2024-05-13T14:30:00.000Z"),
//     "color": "blue",
//     "allDay": false
// }, {
//     "title": "Снятие швов",
//     "start": new Date("2024-05-27T13:30:00.000Z"),
//     "end": new Date("2024-05-27T13:30:00.000Z"),
//     "color": "blue",
//     "allDay": false
// }, {
//     "title": "Повторный прием",
//     "start": new Date("2024-05-22T08:45:00.000Z"),
//     "end": new Date("2024-05-22T08:45:00.000Z"),
//     "color": "indigo",
//     "allDay": false
// }, {
//     "title": "Укол от бешенства",
//     "start": new Date("2024-05-20T04:15:00.000Z"),
//     "end": new Date("2024-05-20T06:15:00.000Z"),
//     "color": "green",
//     "allDay": true
// }, {
//     "title": "Повторный прием",
//     "start": new Date("2024-05-02T05:00:00.000Z"),
//     "end": new Date("2024-05-02T03:30:00.000Z"),
//     "color": "cyan",
//     "allDay": true
// }, {
//     "title": "Консультация",
//     "start": new Date("2024-05-09T13:45:00.000Z"),
//     "end": new Date("2024-05-09T13:45:00.000Z"),
//     "color": "indigo",
//     "allDay": false
// }, {
//     "title": "Укол",
//     "start": new Date("2024-05-23T09:00:00.000Z"),
//     "end": new Date("2024-05-23T09:00:00.000Z"),
//     "color": "blue",
//     "allDay": false
// }, {
//     "title": "Осмотр",
//     "start": new Date("2024-05-14T03:45:00.000Z"),
//     "end": new Date("2024-05-14T03:45:00.000Z"),
//     "color": "deep-purple",
//     "allDay": false
// }, {
//     "title": "Операция",
//     "start": new Date("2024-05-05T08:30:00.000Z"),
//     "end": new Date("2024-05-05T09:15:00.000Z"),
//     "color": "indigo",
//     "allDay": true
// }, {
//     "title": "Снятие швов",
//     "start": new Date("2024-05-01T11:00:00.000Z"),
//     "end": new Date("2024-05-01T11:00:00.000Z"),
//     "color": "indigo",
//     "allDay": true
// },])
const colors = reactive(['blue', 'indigo', 'deep-purple', 'cyan', 'green', 'orange', 'grey darken-1'])
const titles = reactive(['Укол', 'Осмотр', 'Операция', 'Консультация', 'Повторный прием', 'Кастрация', 'Укол от бешенства', 'Снятие швов'])

const getDay = (date) => {
    const WeekDays = ['7', '1', '2', '3', '4', '5', '6'];
    return WeekDays[date.weekday];

}
const getEvents = ({start, end}) => {
    const evs = []


    const min = start
    const max = end
    const days = (max.getTime() - min.getTime()) / 86400000
    const eventCount = rnd(days, days + 20)

    for (let i = 0; i < eventCount; i++) {
        const allDay = rnd(0, 3) === 0
        const firstTimestamp = rnd(min.getTime(), max.getTime())
        const first = new Date(firstTimestamp - (firstTimestamp % 900000))
        const secondTimestamp = rnd(2, allDay ? 288 : 8) * 900000
        const second = new Date(first.getTime() + secondTimestamp)

        evs.push({
            title: titles[rnd(0, titles.length - 1)],
            start: first,
            end: second,
            color: colors[rnd(0, colors.length - 1)],
            allDay: !allDay,
        })
    }
    events.value = evs

}

const getEventColor = (event) => {
    return event.color
}

const rnd = (a, b) => {
    return Math.floor((b - a + 1) * Math.random()) + a
}

const goToAppointmentForm = () => {
    // router.post(route('AddAppointment')); TODO
}

</script>

<style scoped>
.appoint-chip :deep( .v-chip__content) {
}
</style>
