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
                <div v-for="card in cards" :key="card.title">
                    <v-card class="mx-auto my-12 mr-5" max-width="374">
                        <div class="card-group">
                            <div class="text-center">
                                <v-card-text>
                                    <div>
                                        <p>
                                            <v-icon color="black" small
                                                >mdi-calendar</v-icon
                                            >
                                            {{ card.date }}
                                            <v-icon color="black" small
                                                >mdi-clock-time-eight</v-icon
                                            >
                                            {{ card.heure }}
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
                                <h3 class="mb-3">{{ card.title }}</h3>
                                <p>{{ card.fonction }}</p>
                                <p class="mt-3">{{ card.adresse }}</p>
                                <button class="buttonCustom mt-3">
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
                <div v-for="card in cards" :key="card.title">
                    <v-card class="mx-auto my-12 mr-5" max-width="374">
                        <div class="card-group">
                            <div class="text-center">
                                <v-card-text>
                                    <div>
                                        <p>
                                            <v-icon color="black" small
                                                >mdi-calendar</v-icon
                                            >
                                            {{ card.date }}
                                            <v-icon color="black" small
                                                >mdi-clock-time-eight</v-icon
                                            >
                                            {{ card.heure }}
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
                                <h3 class="mb-3">{{ card.title }}</h3>
                                <p>{{ card.fonction }}</p>
                                <p class="mt-3">{{ card.adresse }}</p>
                            </div>
                        </div>
                    </v-card>
                </div>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
    name: "MesRendezVous",
    data: () => ({
        justify: ["center"],
        cards: [
            {
                title: "Dr Ariel COHEN",
                fonction: "Ophtalmologue",
                date: "16 décembre 2021",
                heure: "14:40",
            },
        ],
    }),
    async beforeCreate() {
        if (localStorage.getItem("token") == null) {
            this.$router.push("/login");
        }
    },
};
</script>
