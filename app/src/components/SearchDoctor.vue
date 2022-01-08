<style scoped lang="scss">
a {
    color: white !important;
}
</style>
<template>
    <div>
        <v-container>
            <v-row>
                <v-col cols="4">
                    <v-text-field
                        label="Nom, spécialité, établissement..."
                        placeholder="Nom, spécialité, établissement..."
                        filled
                        rounded
                        dense
                        large
                        prepend-icon="mdi-magnify"
                    ></v-text-field>
                </v-col>
                <v-col cols="4">
                    <v-text-field
                        label="Où ?"
                        placeholder="Adresse"
                        filled
                        rounded
                        dense
                        large
                        prepend-icon="mdi-map-marker"
                    ></v-text-field>
                </v-col>
                <v-col cols="4">
                    <a>
                        <button class="buttonCustom">
                            <div class="height-fix">Rechercher</div>
                        </button>
                    </a>
                </v-col>
            </v-row>
        </v-container>
        <v-container>
            <v-row>
                <h3 class="text-center">- Les résultats de recherches -</h3>
            </v-row>

            <v-row>
                <div :key="index" v-for="(doctor, index) in doctor">
                    <v-card
                        class="mx-auto my-12 mr-5"
                        max-width="374"
                        v-if="doctor.roles[0] == 'ROLE_DOCTOR'"
                    >
                        <div class="card-group">
                            <div class="text-center">
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
                                <h3
                                    v-if="doctor.roles[0] == 'ROLE_DOCTOR'"
                                    class="mb-3"
                                >
                                    {{ doctor.lastname }} {{ doctor.firstname }}
                                </h3>
                                <p v-if="doctor.roles[0] == 'ROLE_DOCTOR'">
                                    {{ doctor.email }}
                                </p>
                                <p
                                    v-if="doctor.roles[0] == 'ROLE_DOCTOR'"
                                    class="mt-3"
                                >
                                    {{ doctor.email }}
                                </p>
                                <button class="buttonCustom mt-3">
                                    <div class="height-fix">
                                        <v-icon color="white"
                                            >mdi-information</v-icon
                                        >
                                        <router-link
                                            :to="`/docteur/${doctor[
                                                '@id'
                                            ].slice(11, 13)} `"
                                        >
                                            Prendre rendez-vous
                                        </router-link>
                                    </div>
                                </button>
                                <v-card-text>
                                    <div>
                                        <p
                                            v-if="
                                                doctor.roles[0] == 'ROLE_DOCTOR'
                                            "
                                        >
                                            {{ doctor.email }}
                                        </p>
                                    </div>
                                </v-card-text>
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
    name: "SearchDoctor",
    data: () => ({
        justify: ["center"],
        user: null,
        doctor: null,
    }),
    methods: {
        getData() {
            axios.get("/users").then((response) => {
                this.doctor = response.data["hydra:member"];
                console.log(this.doctor);
            });
        },
    },
    mounted() {
        this.getData();
        console.log(this.doctor);
    },
    async created() {
        delete axios.defaults.headers.common["Authorization"];
    },
};
</script>
