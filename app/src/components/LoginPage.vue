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
                                    required
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
                                    required
                                    dense
                                    large
                                    filled
                                    rounded
                                    v-model="password"
                                ></v-text-field>
                                <v-row>
                                    <button
                                        type="submit"
                                        class="buttonCustom ml-4 mb-3 mr-6"
                                    >
                                        Se connecter
                                    </button>
                                    Pas de compte ?
                                    <router-link to="/register" class="ml-2"
                                        >Inscrivez-vous !</router-link
                                    >
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
        };
    },
    methods: {
        async handleSubmit() {
            const response = await axios.post(
                "http://localhost:8000/api/login_check",
                {
                    username: this.username,
                    password: this.password,
                }
            );
            console.log(response);
            this.$router.push("/mes-rendez-vous");
        },
    },
};
</script>
