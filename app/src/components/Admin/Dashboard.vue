<style scoped lang="scss"></style>
<template>
    <div>
        <v-container style="height: 100vh">
            <v-row>
                <v-col cols="12">
                    <h1>Bienvenue {{ admin.name }} administrateur</h1>
                    <h2>Votre dashboard</h2>
                    <h3 class="mt-5">Voici la liste des médecins :</h3>
                </v-col>
            </v-row>

            <v-simple-table>
                <template v-slot:default>
                    <thead>
                        <tr>
                            <th class="text-left">Nom</th>
                            <th class="text-left">Fonction</th>
                            <th class="text-left">Adresse</th>
                            <th class="text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr :key="index" v-for="(doctor, index) in doctor">
                            <td v-if="doctor.roles[0] == 'ROLE_DOCTOR'">
                                {{ doctor.lastname }} {{ doctor.firstname }}
                            </td>
                            <td v-if="doctor.roles[0] == 'ROLE_DOCTOR'">
                                {{ doctor.email }}
                            </td>
                            <td v-if="doctor.roles[0] == 'ROLE_DOCTOR'">
                                {{ doctor.roles[0] }}
                            </td>
                            <td v-if="doctor.roles[0] == 'ROLE_DOCTOR'">
                                <a @submit.prevent="remove"> delete</a>
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
        admin: {
            name: "Dr Ariel COHEN",
            fonction: "Ophtalmologue",
            adresse: "16 Avenue Anatole France 93600 Aulnay-sous-Bois",
        },
    }),
    mounted() {
        axios.get("/users").then((response) => {
            this.doctor = response.data["hydra:member"];
        });
    },
    async remove() {
        await axios.delete("/users");
    },
};
</script>
