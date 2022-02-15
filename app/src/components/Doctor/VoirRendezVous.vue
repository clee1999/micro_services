<style scoped lang="scss"></style>
<template>
    <div>
        <v-container style="height: 100vh">
            <v-row>
                <v-col cols="12">
                    <h2>Voir les rendez-vous</h2>
                </v-col>
            </v-row>
            <v-row>
                <v-alert
                    color="green"
                    dense
                    elevation="11"
                    type="success"
                    v-if="result != null"
                    style="margin-bottom: 20px"
                >
                    <v-icon color="white">mdi-check</v-icon>
                    {{ result }}</v-alert
                >
            </v-row>

            <v-simple-table>
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th class="text-left">id</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Patient</th>
                            <th class="text-left">Heure / Date</th>
                            <th class="text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            :key="index"
                            v-for="(reservation, index) in reservations"
                        >
                            <td v-if="reservation.doctor == iriDoctor">
                                {{ reservation["@id"] | truncate(26) }}
                            </td>
                            <td v-if="reservation.doctor == iriDoctor">
                                {{ reservation.description }}
                            </td>
                            <td v-if="reservation.doctor == iriDoctor">
                                {{ reservation.patient.data.firstname }}
                                {{ reservation.patient.data.lastname }}
                            </td>
                            <td v-if="reservation.doctor == iriDoctor">
                                {{ getSlotDate(reservation.slot.data) }}
                                {{ getSlotView(reservation.slot.data) }}
                            </td>
                            <td v-if="reservation.doctor == iriDoctor">
                                <button
                                    v-on:click="deleteReservation(reservation)"
                                >
                                    <v-icon color="red">mdi-delete</v-icon>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </template>
            </v-simple-table>
        </v-container>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "VoirRendezVous",
    data: () => ({
        justify: ["center"],
        doctor: null,
        user: null,
        result: null,
        role: null,
        patient: null,
        reservations: [],
        iriDoctor: null,
    }),
    methods: {
        getSlotDate(slot) {
            //   let d = new Date(slot.slotStart);
            return String(slot.slotStart).split("T")[0];
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
        getData() {
            //   let reservations = [];
            axios
                .get("http://localhost:8002/api/reservations")
                .then((response) => {
                    this.doctor = response.data["hydra:member"];
                    response.data["hydra:member"].forEach((reservation) => {
                        let pid = reservation.patient.split("/")[3];
                        let sid = reservation.slot.split("/")[3];
                        axios
                            .get(`/users/${pid}`)
                            .then((result) => {
                                reservation.patient = result;
                            })
                            .catch((err) => {
                                console.log(err);
                            });
                        axios
                            .get(`http://localhost:8001/api/time_slots/${sid}`)
                            .then((result) => {
                                reservation.slot = result;
                            })
                            .catch((err) => {
                                console.log(err);
                            });
                        this.reservations.push(reservation);
                        console.log(reservation);
                    });
                });
            //   this.reservations = reservations;
            //   console.log(this.reservations);
        },
        deleteReservation(reservation) {
            console.log(reservation.id);
            reservation.available = true;
            axios
                .delete(
                    "http://localhost:8002/api/reservations/" +
                        reservation["@id"].split("/")[3]
                )
                .then(() => {
                    this.reservations = [];
                    this.getData();
                    this.result = "Vous avez supprimé ce rdv";
                })
                .catch((err) => {
                    console.log(err);
                    reservation.available = false;
                });
        },
    },
    mounted() {
        this.getData();
    },
    filters: {
        truncate(doctor, num) {
            const reqdString = doctor.split("").slice(18, num).join("");
            return reqdString;
        },
    },
    async created() {
        const response = await axios.get("me");
        this.user = response.data;
        this.iriDoctor = "/api/users/" + this.user.id;
    },
    async beforeCreate() {
        const response = await axios.get("me");
        this.role = response.data.roles[0];
        if (this.role != "ROLE_DOCTOR") {
            this.$router.push("/login");
        }
    },
};

// id: reservation.patient.split("/")[1],
</script>
