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

            <v-row>
                <v-col cols="12">
                    <div>
                        <v-data-table
                            :headers="headers"
                            :items="doctors"
                            item-key="name"
                            class="elevation-1"
                            :search="search"
                            :custom-filter="filterOnlyCapsText"
                        >
                            <template v-slot:body.append>
                                <tr>
                                    <td colspan="4"></td>
                                </tr>
                            </template>
                        </v-data-table>
                    </div>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>

<script>
export default {
    name: "Dashboard",
    data: () => ({
        justify: ["center"],
        admin: {
            name: "Dr Ariel COHEN",
            fonction: "Ophtalmologue",
            adresse: "16 Avenue Anatole France 93600 Aulnay-sous-Bois",
        },
        search: "",
        doctors: [
            {
                name: "Dr Ariel COHEN",
                fonction: "Ophtalmologue",
                adresse: "16 Avenue Anatole France 93600 Aulnay-sous-Bois",
            },
        ],
    }),
    computed: {
        headers() {
            return [
                { text: "Name", value: "name" },
                { text: "fonction", value: "fonction" },
                { text: "adresse", value: "adresse" },
            ];
        },
    },
};
</script>
