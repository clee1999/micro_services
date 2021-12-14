<style scoped>
p {
    font-family: "Nunito-SemiBold" !important;
}

.itemList {
    color: black !important;
}
</style>
<template>
    <v-app>
        <v-app-bar
            :color="bg"
            fixed
            elevate-on-scroll
            scroll-target="#scrolling-techniques-7"
        >
            <v-toolbar-title white>DoctoCréneau</v-toolbar-title>

            <v-spacer></v-spacer>
            <div class="d-inline-block pl-6"><p>Chercher un médecin</p></div>
            <div class="d-inline-block pl-6"><p>Besoin d'aide ?</p></div>
            <v-menu offset-y>
                <template v-slot:activator="{ on, attrs }">
                    <p class="ml-6">
                        <a dark v-bind="attrs" v-on="on">
                            Se connecter
                            <v-icon color="black">mdi-account-circle</v-icon>
                        </a>
                    </p>
                </template>
                <v-list>
                    <v-list-item v-for="(item, index) in items" :key="index">
                        <v-list-item-title
                            ><p class="itemList">
                                {{ item.title }}
                            </p></v-list-item-title
                        >
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>
        <v-container-fluid>
            <v-main> <HomePage /> </v-main>
        </v-container-fluid>
        <Footer />
    </v-app>
</template>

<script>
import HomePage from "./components/HomePage";
import Footer from "./components/Footer";
export default {
    name: "App",

    components: { HomePage, Footer },

    data: () => ({
        bg: "transparent",
        items: [
            { title: "Click Me" },
            { title: "Click Me" },
            { title: "Click Me" },
            { title: "Click Me 2" },
        ],
    }),
    mounted() {
        window.onscroll = () => {
            console.log("scrooooolll");
            this.changeColor();
        };
    },
    methods: {
        changeColor() {
            if (
                document.body.scrollTop > 100 ||
                document.documentElement.scrollTop > 100
            ) {
                this.bg = "#B9E9F9";
            } else {
                this.bg = "#B9E9F9";
            }
        },
    },
};
</script>
