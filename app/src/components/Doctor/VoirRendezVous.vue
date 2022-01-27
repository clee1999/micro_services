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
                <p class="red--text">
                    {{ result }}
                </p>
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
                            <td>
                                {{ reservation["@id"] | truncate(26) }}
                            </td>
                            <td>
                                {{ reservation.description }}
                            </td>
                            <td>
                                {{ reservation.patient }}
                            </td>
                            <td>
                                {{ reservation.slot }}
                            </td>
                            <td>
                                <button v-on:click="deleteUser(doctor['@id'])">
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
        result: "",
        role: null,
        patient: null,
        reservations: [],
    }),
    methods: {
        getData() {
            let reservations = [];
            axios.get("/reservations").then((response) => {
                this.doctor = response.data["hydra:member"];
                this.doctor.map((reservation) => {
                    const id = reservation.patient.slice(18, 20);
                    axios.get(`users/${id}`).then((response) => {
                        console.log(response);
                        // reservation.patient = response.data[
                        //     "hydra:member"
                        // ].filter(
                        //     (patient) =>
                        //         (patient.id = reservation.patient.split("/")[1])
                        // );

                        reservation.patient = response.data["hydra:member"];
                        reservations.push(reservation);
                    });
                });
            });
            this.reservations = reservations;
            console.log(this.reservations);
        },
        deleteUser(id) {
            axios.delete("/reservations/" + id.slice(18, 20)).then(() => {
                this.getData();
                this.result = "Vous avez supprimé ce rdv";
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
