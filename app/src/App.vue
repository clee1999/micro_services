<style scoped>
p {
    font-family: "Nunito-SemiBold", serif !important;
}

/*.v-app-bar {*/
/*    background: #22bff3 !important;*/
/*}*/

/*.itemList {*/
/*    color: black !important;*/
/*}*/

a {
    color: white !important;
}
</style>
<template>
    <v-app>
        <v-app-bar elevate-on-scroll scroll-target="#scrolling-techniques-7">
            <v-toolbar-title white>
                <router-link to="/">DoctoCréneau</router-link>
            </v-toolbar-title>

            <v-spacer></v-spacer>
            <div class="d-inline-block pl-6">
                <p>
                    <router-link to="/recherche">
                        Chercher un médecin
                    </router-link>
                </p>
            </div>
            <div class="d-inline-block pl-6">
                <p>
                    <router-link to="/login">Se connecter
                    </router-link>
                </p>
            </div>

        </v-app-bar>
        <v-container fluid>
            <v-main>
                <router-view></router-view>
            </v-main>
        </v-container>
        <Footer/>
    </v-app>
</template>

<script>
import Footer from "./components/Footer";

export default {
    name: "App",

    components: {Footer},

    data: () => ({
        bg: "transparent",
        items: [
            {title: "Click Me"},
            {title: "Click Me"},
            {title: "Click Me"},
            {title: "Click Me 2"},
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
