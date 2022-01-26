<style scoped lang="scss"></style>
<template>
    <div>
        <v-container style="height: 100vh">
            <v-stepper v-model="e1">
                <v-stepper-header>
                    <v-stepper-step :complete="e1 > 1" step="1">
                        Choix du créneaux
                    </v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step :complete="e1 > 2" step="2">
                        Connexion / Inscription
                    </v-stepper-step>

                    <v-divider></v-divider>
                    <v-stepper-step :complete="e1 > 3" step="3">
                        Récapitulatif
                    </v-stepper-step>

                    <v-divider></v-divider>

                    <v-stepper-step step="4"> Validation </v-stepper-step>
                </v-stepper-header>

                <v-stepper-items>
                    <v-stepper-content step="1">
                        <v-container>
                            <v-row align="center">
                                <v-date-picker
                                    v-model="date"
                                    full-width
                                    class="mt-4"
                                ></v-date-picker>
                            </v-row>
                        </v-container>
                        <v-btn color="primary" @click="e1 = 2">
                            Continue
                        </v-btn>

                        <v-btn text> Cancel </v-btn>
                    </v-stepper-content>

                    <v-stepper-content step="2">
                        <v-container>
                            <v-row>
                                <v-col cols="12">
                                    <h3 v-if="user">
                                        Vous êtes connecté en tant que
                                        {{ user.firstname }}
                                        {{ user.lastname }}
                                    </h3>
                                </v-col>
                            </v-row>
                            <v-row v-if="!user">
                                <v-col cols="12">
                                    <h3>Pas encore de compte ?</h3>
                                    <button class="buttonCustom">
                                        <div class="height-fix">
                                            Créer un compte
                                        </div>
                                    </button>
                                </v-col>
                            </v-row>
                            <v-row v-if="!user">
                                <v-col cols="12">
                                    <!-- TODO : pour chacun des boutons, href vers les pages de connexion / inscription -->
                                    <!-- TODO : Display ces boutons si l'user est un invité, si déjà connecté les masqués -->
                                    <h3>Déjà un compte ?</h3>
                                    <button class="buttonCustom">
                                        <div class="height-fix">
                                            Se connecter
                                        </div>
                                    </button>
                                </v-col>
                            </v-row>
                        </v-container>
                        <v-btn color="primary" @click="e1 = 3">
                            Continue
                        </v-btn>

                        <v-btn text> Cancel </v-btn>
                    </v-stepper-content>

                    <v-stepper-content step="3">
                        <form @submit.prevent="handleSubmit">
                            <v-container>
                                <v-row class="text-center">
                                    <v-col cols="12">
                                        <h2>Récapitulatif du rendez-vous</h2>
                                    </v-col>
                                </v-row>
                                <v-row class="text-center">
                                    <v-col cols="12">
                                        <h4 v-if="user">
                                            {{ user.name }}, vous avez pris un
                                            rendez-vous pour le :
                                        </h4>
                                        <p>Date :</p>
                                        <p>à l'heure</p>
                                        <p>Chez le practicien :</p>
                                    </v-col>
                                </v-row>
                            </v-container>
                            <button class="buttonCustom ml-4 mb-3 mr-6">
                                S'inscrire
                            </button>
                            <v-btn color="primary" @click="e1 = 4">
                                Continue
                            </v-btn>
                        </form>
                        <v-btn text> Cancel </v-btn>
                    </v-stepper-content>

                    <v-stepper-content step="4">
                        <v-container>
                            <v-row class="text-center">
                                <v-col cols="12">
                                    <v-icon color="green" x-large
                                        >mdi-calendar-check</v-icon
                                    >
                                    <h2>Votre réservation a été confirmé !</h2>
                                    <router-link to="/mes-rendez-vous"
                                        >Voir mes rendez-vous</router-link
                                    >
                                </v-col>
                            </v-row>
                        </v-container>
                        <v-btn color="primary" @click="e1 = 1">
                            Continue
                        </v-btn>

                        <v-btn text> Cancel </v-btn>
                    </v-stepper-content>
                </v-stepper-items>
            </v-stepper>
        </v-container>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "StepperReservation",
    data() {
        return {
            e1: 1,
            user: null,
            description: "",
            patient: "",
            doctor: null,
            date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
                .toISOString()
                .substr(0, 10),
        };
    },
    methods: {
        async handleSubmit() {
            const id = this.$route.params.id;
            try {
                const response = await axios.post("reservations", {
                    description: "test",
                    patient: `api/users/${id}`,
                    doctor: `api/users/${id}`,
                    slot: this.date,
                });
                console.log("ok");
                if (response.data.success) {
                    console.log("ok");
                } else {
                    this.errors = response.data.message;
                }
            } catch (error) {
                this.errors = error.response.data.message;
            }
        },
        getData() {
            const id = this.$route.params.id;

            axios.get(`users/${id}`).then((response) => {
                this.doctor = response.data;
                console.log(this.doctor);
            });
        },
    },
    mounted() {
        this.getData();
    },
    async created() {
        const response = await axios.get("me");
        this.user = response.data;
        console.log("The id is: " + this.$route.params.id);
    },
};
</script>
