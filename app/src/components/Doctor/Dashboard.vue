<style scoped lang="scss"></style>
<template>
    <div>
        <v-container style="height: 100vh">
            <v-row>
                <v-col cols="12">
                    <h1>
                        Bienvenue Doctor {{ user.firstname }}
                        {{ user.lastname }}
                    </h1>
                    <h2>Votre dashboard</h2>
                </v-col>
                <router-link to="/gerer-creneaux">
                    Gérer les créneaux
                </router-link>
                <router-link to="/voir-rendez-vous">
                    Voir les rendez-vous
                </router-link>
            </v-row>
            <v-main>
                <router-view></router-view>
            </v-main>
        </v-container>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "DashboardDoctor",
    data: () => ({
        justify: ["center"],
        doctor: null,
        user: null,
        result: "",
        role: null,
    }),
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
</script>
