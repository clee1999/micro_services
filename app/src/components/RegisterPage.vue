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
                            <form @submit.prevent="handleSubmit">
                                <v-text-field
                                    label="Prénom"
                                    prepend-icon="mdi-account"
                                    color="black"
                                    required
                                    dense
                                    large
                                    filled
                                    rounded
                                    v-model="firstname"
                                />
                                <v-text-field
                                    label="Nom de famille"
                                    prepend-icon="mdi-account-circle"
                                    color="black"
                                    required
                                    dense
                                    large
                                    filled
                                    rounded
                                    v-model="lastname"
                                />
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
                                    v-model="email"
                                />
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
                                    v-model="password"
                                />
                                <v-text-field
                                    label="Téléphone"
                                    placeholder="tel"
                                    prepend-icon="mdi-phone"
                                    color="black"
                                    type="tel"
                                    pattern="[0-9]{10}"
                                    required
                                    dense
                                    large
                                    filled
                                    rounded
                                    v-model="phone"

                                />
                                <v-dialog
                                    ref="dialog"
                                    v-model="modal"
                                    :return-value.sync="birthday"
                                    persistent
                                    width="290px"
                                >
                                    <template v-slot:activator="{ on, attrs }">
                                        <v-text-field
                                            v-model="birthday"
                                            label="Date de naissance"
                                            prepend-icon="mdi-calendar"
                                            readonly
                                            v-bind="attrs"
                                            v-on="on"
                                            color="black"
                                        />
                                    </template>
                                    <v-date-picker
                                        v-model="birthday"
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
                                            @click="$refs.dialog.save(birthday)"
                                        >
                                            OK
                                        </v-btn>
                                    </v-date-picker>
                                </v-dialog>
                                <v-text-field
                                    label="Adresse"
                                    prepend-icon="mdi-home"
                                    color="black"
                                    required
                                    dense
                                    large
                                    filled
                                    rounded
                                    v-model="address"
                                />
                                <v-text-field
                                    label="Ville"
                                    prepend-icon="mdi-warehouse"
                                    color="black"
                                    required
                                    dense
                                    large
                                    filled
                                    rounded
                                    v-model="city"
                                />
                                <v-row><p class="red--text">{{ errors }}</p></v-row>
                                <v-row>
                                    <button class="buttonCustom ml-4 mb-3 mr-6">
                                        S'inscrire
                                    </button>
                                    Déjà un compte ?
                                    <router-link to="/login" class="ml-2"
                                    >Connectez vous !
                                    </router-link
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
    name: "RegisterPage",
    data() {
        return {
            firstname: "",
            lastname: "",
            email: "",
            password: "",
            birthday: "",
            phone: "",
            address: "",
            city: "",
            errors: "",
        };
    },
    methods: {
        async handleSubmit() {
            try {
                const response = await axios.post(
                    "http://localhost:8000/api/users",
                    {
                        firstname: this.firstname,
                        lastname: this.lastname,
                        email: this.email,
                        password: this.password,
                        birthday: this.birthday,
                        phone: this.phone,
                        address: this.address,
                        city: this.city,
                    }
                );
                if (response.data.success) {
                    this.$router.push("/login");
                } else {
                    this.errors = response.data.message;
                }
            } catch (error) {
                this.errors = error.response.data.message;
            }
        }
    }
};
</script>
