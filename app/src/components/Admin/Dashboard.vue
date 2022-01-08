<style scoped lang="scss"></style>
<template>
    <div>
        <v-container style="height: 100vh">
            <v-row>
                <v-col cols="12">
                    <h1>
                        Bienvenue {{ user.firstname }}
                        {{ user.lastname }} administrateur
                    </h1>
                    <h2>Votre dashboard</h2>
                    <h3 class="mt-5">Voici la liste des médecins :</h3>
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
                            <th class="text-left">Nom</th>
                            <th class="text-left">Fonction</th>
                            <th class="text-left">Adresse</th>
                            <th class="text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr :key="index" v-for="(doctor, index) in doctor">
                            <td v-if="doctor.roles[0] == 'ROLE_DOCTOR'">
                                {{ doctor["@id"] | truncate(13) }}
                            </td>
                            <td v-if="doctor.roles[0] == 'ROLE_DOCTOR'">
                                {{ doctor.lastname }} {{ doctor.firstname }}
                            </td>
                            <td v-if="doctor.roles[0] == 'ROLE_DOCTOR'">
                                {{ doctor.email }}
                            </td>
                            <td v-if="doctor.roles[0] == 'ROLE_DOCTOR'">
                                {{ doctor["@id"] | truncate(13) }}
                            </td>
                            <td v-if="doctor.roles[0] == 'ROLE_DOCTOR'">
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
    name: "Dashboard",
    data: () => ({
        justify: ["center"],
        doctor: null,
        user: null,
        result: "",
    }),
    methods: {
        getData() {
            axios.get("/users").then((response) => {
                this.doctor = response.data["hydra:member"];
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
    },
};
</script>
