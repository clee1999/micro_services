<style scoped>
p {
    font-family: "Nunito-SemiBold", serif !important;
}

.v-app-bar {
    background: #22bff3 !important;
}

.itemList {
    color: black !important;
}

a {
    color: white !important;
}

.v-list a {
    color: black !important;
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
                    <router-link v-if="roleAdmin === 'ROLE_ADMIN'" to="/admin"
                        >Gérer les médecins
                    </router-link>
                    <router-link
                        v-if="roleDoctor === 'ROLE_DOCTOR'"
                        to="/doctor"
                        >Gérer les rendez-vous
                    </router-link>
                </p>
            </div>
            <v-menu offset-y>
                <template v-slot:activator="{ on, attrs }">
                    <p class="ml-6">
                        <a dark v-bind="attrs" v-on="on">
                            <v-icon v-if="!user" color="white"
                                >mdi-account-circle</v-icon
                            >
                            <router-link v-if="!user" to="/login"
                                >Se connecter
                            </router-link>
                            <p v-if="user">
                                {{ user.firstname }} {{ user.lastname }} +
                            </p>
                        </a>
                    </p>
                </template>
                <v-list v-if="user">
                    <v-list-item v-for="(item, index) in items" :key="index">
                        <v-list-item-title>
                            <router-link :to="item.link">{{
                                item.title
                            }}</router-link>
                            <p>
                                <a
                                    href="javascript:void(0)"
                                    @click="handleClick()"
                                    >Se déconnecter</a
                                >
                            </p>
                        </v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>
        <v-main>
            <router-view></router-view>
        </v-main>
        <Footer />
    </v-app>
</template>

<script>
import Footer from "./components/Footer";
import axios from "axios";

export default {
    name: "App",

    components: { Footer },

    data: () => ({
        user: null,
        bg: "transparent",
        roleAdmin: null,
        roleDoctor: null,
        items: [{ title: "Mes rendez-vous", link: "/mes-rendez-vous" }],
    }),
    mounted() {
        window.onscroll = () => {
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
        handleClick() {
            localStorage.removeItem("token");
            this.$router.push("/");
        },
    },
    async created() {
        const response = await axios.get("me");
        this.user = response.data;
        this.roleAdmin = response.data.roles[0];
        this.roleDoctor = response.data.roles[0];
    },
};
</script>
