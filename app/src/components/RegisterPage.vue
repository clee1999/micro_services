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
                            <h3>- Inscription -</h3>
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
                                />
                                <v-text-field
                                    label="Téléphone"
                                    placeholder=""
                                    type="email"
                                    prepend-icon="mdi-phone"
                                    color="black"
                                    required
                                    dense
                                    large
                                    filled
                                    rounded
                                />
                                <v-dialog
                                    ref="dialog"
                                    v-model="modal"
                                    :return-value.sync="date"
                                    persistent
                                    width="290px"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            v-model="date"
                                            label="Date de naissance"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                            color="black"
                                        />
                                    </template>
                                    <v-date-picker
                                        v-model="date"
                                        scrollable
                                        color="#fa8d57"
                                    >
                                        <v-spacer/>
                                        <v-btn
                                            text
                                            color="#fa8d57"
                                            @click="modal = false"
                                        >
                                            Cancel
                                        </v-btn>
                                        <v-btn
                                            text
                                            color="#fa8d57"
                                            @click="$refs.dialog.save(date)"
                                        >
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-dialog>
                                <v-text-field
                                    label="Mot de passe"
                                    type="password"
                                    prepend-icon="mdi-lock"
                                    color="black"
                                    required
                                    dense
                                    large
                                    filled
                                    rounded
                                />
                                <v-text-field
                                    label="Confirmation du mot de passe"
                                    type="password"
                                    prepend-icon="mdi-lock"
                                    color="black"
                                    required
                                    dense
                                    large
                                    filled
                                    rounded
                                />
                                <v-row>
                                    <button class="buttonCustom ml-4 mb-3 mr-6">
                                        S'inscrire
                                    </button>
                                    Déjà un compte ?
                                    <router-link to="/login" class="ml-2">Connectez vous !</router-link>
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
    name: 'RegisterPage',
    data() {
        return {
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                phone: '',
                address: '',
                city: ''
            }
        }
    },
    methods: {
        register() {
            //
        }
    }
}
</script>
