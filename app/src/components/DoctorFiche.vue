<style scoped lang="scss">
h4 {
    margin-top: 20px !important;
}

h2 {
    color: #fa7f57;
}

a {
    color: white !important;
}
</style>
<template>
    <div>
        <v-container style="height: 100vh">
            <v-card class="mx-auto" max-width="full" outlined>
                <v-list-item three-line>
                    <v-list-item-content>
                        <div class="text-overline mb-4">
                            {{ doctor.metier }}
                        </div>
                        <v-list-item-title class="text-h5 mb-5">
                            {{ doctor.firstname }} {{ doctor.lastname }}
                        </v-list-item-title>
                        <h4>Informations d'accès</h4>
                        <p>{{ doctor.address }}, {{ doctor.city }}</p>
                        <h4>Présentation de l'établissement</h4>
                        <p>{{ doctor.descriptionDoctor }}</p>
                        <h4>Contacts</h4>
                        <p>{{ doctor.phone }}</p>
                        <p>{{ doctor.email }}</p>
                    </v-list-item-content>

                    <v-list-item-avatar
                        tile
                        size="180"
                        color="grey"
                    ></v-list-item-avatar>
                </v-list-item>
            </v-card>
            <v-row class="text-center mt-10">
                <v-col cols="12">
                    <button class="buttonCustom mt-3">
                        <div class="height-fix">
                            <router-link
                                :to="`/reservation/${doctor['@id'].slice(
                                    11,
                                    13
                                )} `"
                            >
                                Prendre rendez-vous
                            </router-link>
                        </div>
                    </button>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
import axios from "axios";
export default {
    name: "DoctorFiche",
    data: () => ({
        doctor: null,
    }),
    methods: {
        getData() {
            const id = this.$route.params.id;

            axios.get(`users/${id}`).then((response) => {
                this.doctor = response.data;
            });
        },
    },
    mounted() {
        this.getData();
    },
    async created() {
        delete axios.defaults.headers.common["Authorization"];
    },
};
</script>
