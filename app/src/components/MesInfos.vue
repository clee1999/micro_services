<template>
    <div class="bg">
        <v-container>
            <v-col>
                <v-row><h1>Mon Profil</h1></v-row>

                <v-row class="py-2 font-weight-bold">
                    Prénom: {{ firstname }}
                </v-row>
                <v-row class="py-2 font-weight-bold">
                    Nom: {{ lastname }}
                </v-row>
                <v-row class="py-2 font-weight-bold">
                    Email: {{ email }}
                </v-row>
                <v-row class="py-2 font-weight-bold">
                    Téléphone: {{ phone }}
                </v-row>
                <v-row class="py-2 font-weight-bold">
                    Adresse: {{ address }}
                </v-row>
                <v-row>
                    <v-avatar size="200">
                        <img :src="image" alt="avatar">
                    </v-avatar>
                </v-row>
                <v-row>
                    <form @submit.prevent="handleSubmit">
                        <v-file-input
                            v-model="image"
                            label="Changer l'avatar"
                            accept="image/png, image/jpeg, image/jpg"
                            placeholder="Changer l'avatar"
                            prepend-icon="mdi-camera"
                            outline/>
                        <v-btn type="submit"> Sauvegarder</v-btn>
                    </form>
                </v-row>
            </v-col>
        </v-container>
    </div>
</template>
<script>
import axios from "axios";

export default {
    name: 'MesInfos',
    data() {
        return {
            firstname: '',
            lastname: '',
            email: '',
            phone: '',
            address: '',
            city: '',
            birthday: '',
            image: ''
        }
    },
    mounted() {
        axios.get('me').then(response => {
            this.nom = response.data.lastname;
            this.prenom = response.data.firstname;
            this.email = response.data.email;
            this.phone = response.data.phone;
            this.address = response.data.address;
            this.city = response.data.city;
            this.birthday = response.data.birthday;
            this.image = response.data.image;
        });
    },
    methods: {
        async handleSubmit() {
            try {
                const response = await axios.post(`users/me/image`, {
                    image: this.image
                });
                console.log(response);
            } catch (error) {
                console.log(error);
            }
        }
    }
}
</script>
