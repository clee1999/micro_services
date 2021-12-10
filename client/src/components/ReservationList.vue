<template>
    <!-- List with vue and tailwindcss -->
    <div class="flex flex-wrap -mx-2">
        <div class="w-full px-2">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full px-2">
                        <h2 class="text-2xl font-semibold">
                            Reservations
                        </h2>
                    </div>
                </div>

            </div>
            <ul class="ml-8">
                <li class="text-lg" v-for="reservation in reservations" v-bind:key="reservation.id">
                    {{ reservation.cabinet }}, le {{formatDate(reservation.date)}} à {{reservation.time.replace(':','h')}}
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
import * as axios from "core-js";

export default {
    name: 'ReservationList',
    data() {
        return {
            reservations: [
                {id: 1, cabinet: 'Cabinet 1', date: '2020-01-01', time: '10:00'},
                {id: 2, cabinet: 'Cabinet des toilettes', date: '2020-01-01', time: '10:00'},
                {id: 3, cabinet: 'Cabinet Royal', date: '2020-01-01', time: '10:00'},
                {id: 4, cabinet: 'Cabinet 2', date: '2020-01-01', time: '10:00'},
            ],
        }
    },
    methods: {
        //function that format the date to DD/MM/YYYY in vanilla JS
        formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [day, month, year].join('/');
        },
        getReservations() {
            axios.get('/api/reservations/${this.user.id}')
                .then(response => {
                    this.reservations = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
    },
    mounted() {
        this.getReservations();
    },
}
</script>
<style></style>
