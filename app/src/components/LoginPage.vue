<style scoped lang="scss">
.bg {
    width: 100%;
    height: 100vh;
    background: #22bff3;
    background-size: cover;
    background-position: center;
    display: flex;
    flex-direction: column;
}

.red--text {
    color: #f44336 !important;
    padding-left: 2rem;
    padding-bottom: 2rem;
}
</style>
<template>
    <div class="bg">
        <v-container>
            <v-row>
                <v-col lg>
                    <v-card>
                        <v-card-title class="text-center">
                            <h3>- Connexion -</h3>
                        </v-card-title>
                        <v-card-text>
                            <form @submit.prevent="handleSubmit">
                                <v-text-field
                                    label="Email"
                                    placeholder="jean.bernard@mail.com"
                                    type="email"
                                    prepend-icon="mdi-email"
                                    color="black"
                                    dense
                                    large
                                    filled
                                    rounded
                                    v-model="username"
                                ></v-text-field>
                                <v-text-field
                                    label="Password"
                                    type="password"
                                    prepend-icon="mdi-lock"
                                    color="black"
                                    dense
                                    large
                                    filled
                                    rounded
                                    v-model="password"
                                ></v-text-field>
                                <v-row>
                                    <p class="red--text">
                                        {{ errors }}
                                    </p>
                                </v-row>
                                <v-row>
                                    <button
                                        type="submit"
                                        class="buttonCustom ml-4 mb-3 mr-6"
                                    >
                                        Se connecter
                                    </button>
                                    Pas de compte ?
                                    <router-link to="/register" class="ml-2"
                                        >Inscrivez-vous !
                                    </router-link>
                                </v-row>
                            </form>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>
<script>
import axios from "axios";

export default {
    name: "LoginPage",
    data() {
        return {
            username: "",
            password: "",
            errors: "",
        };
    },
    methods: {
        parseJwt(token) {
            var base64Url = token.split(".")[1];
            var base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
            var jsonPayload = decodeURIComponent(
                atob(base64)
                    .split("")
                    .map(function (c) {
                        return (
                            "%" +
                            ("00" + c.charCodeAt(0).toString(16)).slice(-2)
                        );
                    })
                    .join("")
            );
            console.log(JSON.parse(jsonPayload));

            return JSON.parse(jsonPayload);
        },
        async handleSubmit() {
            if (this.username && this.password) {
                try {
                    const response = await axios.post("login", {
                        username: this.username,
                        password: this.password,
                    });
                    this.parseJwt(response.data.token);
                    localStorage.setItem("token", response.data.token);
                    this.$router.push("/mes-rendez-vous");
                } catch (error) {
                    this.errors = "Oups, vos identifiants sont incorrects !";
                }
            } else {
                this.errors = "Oups, oubliez pas de remplir tous les champs !";
            }
        },
    },
};
</script>
