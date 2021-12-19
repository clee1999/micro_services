<style scoped lang="scss">
.bg {
    width: 100%;
    height: 100vh;
    /* background-image: url(../assets/img/header-homepage.jpg); */
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
                            <v-form ref="form">
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
                                ></v-text-field>
                                <v-row>
                                    <button class="buttonCustom ml-4 mb-3 mr-6">
                                        Se connecter
                                    </button>
                                    Pas de compte ?
                                    <router-link to="/register" class="ml-2">Inscrivez-vous !</router-link>
                                </v-row>
                            </v-form>
                        </v-card-text>

                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </div>
</template>
<script>
export default {
    name: "LoginPage",
};
</script>
