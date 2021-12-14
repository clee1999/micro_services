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
            <v-row v-for="j in justify" :key="j" :justify="j">
                <v-col v-for="k in 1" :key="k" md="12">
                    <h3 class="text-center">- Les résultats de recherches -</h3>
                </v-col>
            </v-row>
            <v-row v-for="j in justify" :key="j" :justify="j">
                <div v-for="card in cards" :key="card.title">
                    <v-card class="mx-auto my-12 mr-5" max-width="374">
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
                                <h3 class="mb-3">{{ card.title }}</h3>
                                <p>{{ card.fonction }}</p>
                                <p class="mt-3">{{ card.adresse }}</p>
                                <button class="buttonCustom mt-3">
                                    <div class="height-fix">
                                        <v-icon color="white"
                                            >mdi-information</v-icon
                                        >
                                        <router-link to="/docteur">
                                            Prendre rendez-vous
                                        </router-link>
                                    </div>
                                </button>
                                <v-card-text>
                                    <div>
                                        <p>{{ card.description }}</p>
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
export default {
    name: "SearchDoctor",
    data: () => ({
        justify: ["center"],
        cards: [
            {
                title: "Dr Ariel COHEN",
                fonction: "Ophtalmologue",
                adresse: "16 Avenue Anatole France 93600 Aulnay-sous-Bois",
            },
            {
                title: "Dr Ariel COHEN",
                fonction: "Ophtalmologue",
                adresse: "16 Avenue Anatole France 93600 Aulnay-sous-Bois",
            },
            {
                title: "Dr Ariel COHEN",
                fonction: "Ophtalmologue",
                adresse: "16 Avenue Anatole France 93600 Aulnay-sous-Bois",
            },
            {
                title: "Dr Ariel COHEN",
                fonction: "Ophtalmologue",
                adresse: "16 Avenue Anatole France 93600 Aulnay-sous-Bois",
            },
            {
                title: "Dr Ariel COHEN",
                fonction: "Ophtalmologue",
                adresse: "16 Avenue Anatole France 93600 Aulnay-sous-Bois",
            },
            {
                title: "Dr Ariel COHEN",
                fonction: "Ophtalmologue",
                adresse: "16 Avenue Anatole France 93600 Aulnay-sous-Bois",
            },
        ],
    }),
};
</script>
