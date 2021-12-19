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
                            {{ card.fonction }}
                        </div>
                        <v-list-item-title class="text-h5 mb-5">
                            {{ card.title }}
                        </v-list-item-title>
                        <h4>Informations d'accès</h4>
                        <p>{{ card.adresse }}</p>
                        <h4>Présentation de l'établissement</h4>
                        <p>{{ card.description }}</p>
                        <h4>Contacts</h4>
                        <p>{{ card.tel }}</p>
                        <p>{{ card.email }}</p>
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
                            <router-link to="/reservation">
                                Prendre rendez-vous avec docteur
                            </router-link>
                        </div>
                    </button>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
    name: "DoctorFiche",
    data: () => ({
        justify: ["center"],
        card: {
            title: "Dr Ariel COHEN",
            fonction: "Ophtalmologue",
            adresse: "16 Avenue Anatole France 93600 Aulnay-sous-Bois",
            tel: "0121213456",
            mail: "lded@ffff.fr",
            description:
                "Le nouveau centre ophtalmologique Megavision Villepinte, situé au Parc de la Noue (dans la zone commerciale, à droite de la pharmacie), vous accueille du lundi au jeudi de 9h à 19h et le vendredi de 9h à 18h dans une structure moderne et conviviale avec du matériel de pointe.",
        },
    }),
};
</script>
