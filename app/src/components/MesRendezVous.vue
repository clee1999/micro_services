<style scoped lang="scss"></style>
<template>
    <div>
        <v-container>
            <v-row class="text-center">
                <v-col cols="12">
                    <h2>Mes rendez-vous</h2>
                </v-col>
            </v-row>
            <v-row class="text-center">
                <v-col cols="12">
                    <h3>- Mes rendez-vous à venir -</h3>
                </v-col>
            </v-row>
            <v-row v-for="j in justify" :key="j" :justify="j">
                <div :key="index" v-for="(reservation, index) in reservations">
                    <v-card class="mx-auto my-12 mr-5" max-width="374">
                        <div class="card-group">
                            <div class="text-center">
                                <v-card-text>
                                    <div>
                                        <p>
                                            <v-icon color="black" small
                                                >mdi-calendar</v-icon
                                            >
                                            {{ getSlotDate(reservation.slot) }}
                                            <v-icon color="black" small
                                                >mdi-clock-time-eight</v-icon
                                            >
                                            {{ getSlotView(reservation.slot) }}
                                        </p>
                                    </div>
                                </v-card-text>
                                <v-list-item-avatar
                                    tile
                                    size="100"
                                    color="grey"
                                    rounded
                                ></v-list-item-avatar>
                            </div>
                            <div
                                class="card-main-content rounded-lg text-center pa-4"
                            >
                                <h3 class="mb-3">
                                    {{ reservation.doctor.firstname }}
                                    {{ reservation.doctor.last }}
                                </h3>
                                <p>{{ reservation.doctor.metier }}</p>
                                <p class="mt-3">
                                    {{ reservation.doctor.adresse }}
                                </p>
                                <button
                                    class="buttonCustom mt-3"
                                    v-on:click="deleteReservation(reservation)"
                                >
                                    <div class="height-fix">
                                        <v-icon color="white"
                                            >mdi-close-box</v-icon
                                        >

                                        Annuler le rendez-vous
                                    </div>
                                </button>
                            </div>
                        </div>
                    </v-card>
                </div>
            </v-row>
            <v-row class="text-center">
                <v-col cols="12">
                    <h3>- Mes rendez-vous passés -</h3>
                </v-col>
            </v-row>
            <v-row v-for="j in justify" :key="j" :justify="j">
                <div
                    :key="index"
                    v-for="(reservation, index) in lastReservations"
                >
                    <v-card class="mx-auto my-12 mr-5" max-width="374">
                        <div class="card-group">
                            <div class="text-center">
                                <v-card-text>
                                    <div>
                                        <p>
                                            <v-icon color="black" small
                                                >mdi-calendar</v-icon
                                            >
                                            {{ getSlotDate(reservation.slot) }}
                                            <v-icon color="black" small
                                                >mdi-clock-time-eight</v-icon
                                            >
                                            {{ getSlotView(reservation.slot) }}
                                        </p>
                                    </div>
                                </v-card-text>
                                <v-list-item-avatar
                                    tile
                                    size="100"
                                    color="grey"
                                    rounded
                                ></v-list-item-avatar>
                            </div>
                            <div
                                class="card-main-content rounded-lg text-center pa-4"
                            >
                                <h3 class="mb-3">
                                    Dr. {{ reservation.doctor.firstname }}
                                    {{ reservation.doctor.lastname }}
                                </h3>
                                <p>{{ reservation.doctor.metier }}</p>
                                <p class="mt-3">
                                    {{ reservation.doctor.address }}
                                </p>
                            </div>
                        </div>
                    </v-card>
                </div>
            </v-row>
        </v-container>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "MesRendezVous",
    data: () => ({
        justify: ["center"],

        user: null,
        result: null,
        reservations: [],
        lastReservations: [],
    }),
    async beforeCreate() {
        if (localStorage.getItem("token") == null) {
            this.$router.push("/login");
        }
    },
    methods: {
        deleteReservation(reservation) {
            reservation.available = true;
            axios
                .delete(
                    "http://localhost:8002/api/reservations/" +
                        reservation["@id"].split("/")[3]
                )
                .then(() => {
                    reservation.slot.available = true;
                    this.reservations = [];
                    this.lastReservations = [];
                    this.getReservations();
                    this.result = "Vous avez supprimé ce rdv";
                })
                .catch((err) => {
                    console.log(err);
                    reservation.available = false;
                });
        },
        getSlotDate(slot) {
            const options = {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
            };

            let start = new Date(slot.slotStart);
            return start.toLocaleDateString(undefined, options);
        },
        getSlotView(slot) {
            let start = new Date(slot.slotStart);
            let end = new Date(slot.slotEnd);
            return (
                String(start.getHours()).padStart(2, "0") +
                ":" +
                String(start.getMinutes()).padStart(2, "0") +
                " - " +
                String(end.getHours()).padStart(2, "0") +
                ":" +
                String(end.getMinutes()).padStart(2, "0")
            );
        },
        getReservations() {
            axios
                .get("http://localhost:8002/api/reservations")
                .then((response) => {
                    response.data["hydra:member"].forEach((reservation) => {
                        if (
                            reservation.patient ==
                            "/api/users/" + this.user.id
                        ) {
                            let rid = reservation.slot.split("/")[3];
                            axios
                                .get(
                                    `http://localhost:8001/api/time_slots/${rid}`
                                )
                                .then((result) => {
                                    reservation.slot = result.data;
                                    let uid = reservation.doctor.split("/")[3];
                                    axios
                                        .get(`/users/${uid}`)
                                        .then((res) => {
                                            reservation.doctor = res.data;
                                        })
                                        .catch((err) => {
                                            console.log(err);
                                        });

                                    let d = new Date(result.data.slotStart);
                                    if (d > Date.now()) {
                                        this.reservations.push(reservation);
                                    } else {
                                        this.lastReservations.push(reservation);
                                    }
                                })
                                .catch((err) => {
                                    console.log(err);
                                });
                        }
                    });
                    console.log(response);
                })
                .catch((err) => {
                    console.log(err);
                });
            console.log(this.reservations);
            console.log(this.lastReservations);
        },
    },
    async created() {
        const response = await axios.get("me");
        this.user = response.data;
        this.getReservations();
    },
};
</script>
