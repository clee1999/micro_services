<style scoped lang="scss"></style>
<template>
    <div>
        <v-container style="height: auto">
            <v-row>
                <v-col cols="12">
                    <h2>Ajout les créneaux</h2>
                </v-col>
            </v-row>
            <v-row>
                <p class="red--text">
                    {{ result }}
                </p>
            </v-row>

            <form @submit.prevent="handleSubmit">
                <v-expansion-panels multiple>
                    <v-expansion-panel>
                        <v-expansion-panel-header
                            >Début du créneau</v-expansion-panel-header
                        >
                        <v-expansion-panel-content>
                            <v-flex xs4>
                                <v-datetime-picker
                                    v-model="slotStart"
                                ></v-datetime-picker>
                            </v-flex>
                        </v-expansion-panel-content>
                    </v-expansion-panel>

                    <v-expansion-panel>
                        <v-expansion-panel-header
                            >Fin du créneau</v-expansion-panel-header
                        >
                        <v-expansion-panel-content>
                            <v-flex xs4>
                                <v-datetime-picker
                                    v-model="slotEnd"
                                ></v-datetime-picker>
                            </v-flex>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>
                <v-row
                    ><p class="red--text">
                        {{ errors }}
                    </p></v-row
                >
                <v-row class="mt-10">
                    <button class="buttonCustom ml-4 mb-3 mr-6">Ajouter</button>
                </v-row>
            </form>
            <v-row>
                <v-col cols="12">
                    <h2>Mes créneaux</h2>
                </v-col>
            </v-row>
            <v-simple-table>
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th class="text-left">id</th>
                            <th class="text-left">start</th>
                            <th class="text-left">end</th>
                            <th class="text-left">Available</th>
                            <th class="text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr :key="index" v-for="(creneaux, index) in creneaux">
                            <!-- <p>{{ creneaux }}</p> -->
                            <td v-if="creneaux.doctor == iriDoctor">
                                {{ creneaux["@id"] }}
                            </td>
                            <td v-if="creneaux.doctor == iriDoctor">
                                {{ creneaux.slotStart }}
                            </td>
                            <td v-if="creneaux.doctor == iriDoctor">
                                {{ creneaux.slotEnd }}
                            </td>
                            <td v-if="creneaux.doctor == iriDoctor">
                                {{ creneaux.available }}
                            </td>
                            <td v-if="creneaux.doctor == iriDoctor">
                                <button
                                    v-on:click="deleteUser(creneaux['@id'])"
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
    name: "GestionCrenau",
    data: () => ({
        justify: ["center"],
        doctor: null,
        user: null,
        result: "",
        role: null,
        slotStart: new Date(),
        slotEnd: new Date(),
        nullDatetime: null,
        datetime: new Date(),
        datetimeString: "2019-01-01 12:00",
        formattedDatetime: "09/01/2019 12:00",
        textFieldProps: {
            appendIcon: "event",
        },
        dateProps: {
            headerColor: "red",
        },
        timeProps: {
            useSeconds: true,
            ampmInTitle: true,
        },
        available: "",
        creneaux: "",
    }),
    methods: {
        async handleSubmit() {
            try {
                const response = await axios.post("/time_slots", {
                    slotStart: this.slotStart,
                    slotEnd: this.slotEnd,
                    available: true,
                    doctor: "/api/users/" + this.user.id,
                });
                if (response.data.success) {
                    console.log(response);
                } else {
                    this.errors = response.data.message;
                    console.log(response);
                }
            } catch (error) {
                this.errors = error.response.data.message;
            }
        },
        getData() {
            axios.get("/time_slots").then((response) => {
                this.creneaux = response.data["hydra:member"];
            });
        },
        deleteUser(id) {
            axios.delete("/users/" + id.slice(11, 13)).then(() => {
                this.getData();
                this.result = "Vous avez supprimé un docteur";
            });
        },
    },
    mounted() {
        this.getData();
        // this.iriDoctor = "/api/users/" + this.user.id;
    },
    filters: {
        truncate(doctor, num) {
            const reqdString = doctor.split("").slice(11, num).join("");
            return reqdString;
        },
    },
    async created() {
        const response = await axios.get("me");
        this.user = response.data;
        console.log(this.user);
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
</script>
