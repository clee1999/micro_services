<style scoped lang="scss">
header {
    width: 100%;
    height: 100vh;
    /* background-image: url(../assets/img/header-homepage.jpg); */
    background: #22bff3;
    background-size: cover;
    background-position: center;
    display: flex;
    flex-direction: column;
}

header .top-gradient {
    width: 100%;
    height: 300px;
    position: absolute;
    top: 0;
    left: 0;
    flex-grow: 1;
}
.header-wrapper {
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.header-wrapper .content-wrapper {
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    align-items: flex-start;
    color: white;
    flex-grow: 2;
    margin-bottom: 200px;
}

.header-wrapper .content-wrapper .main-title {
    margin-bottom: 16px;
}

#resume {
    padding: 10px 0;
    color: rgb(0, 0, 0);

    .card {
        max-width: 250px;
    }

    img {
        width: 190px;
    }
}

@media screen and (max-width: 675px) {
    .content-wrapper {
        padding: 0 20px;
        margin-bottom: 100px !important;
    }

    .content-wrapper button {
        margin: 0 auto;
    }
}
</style>
<template>
    <div>
        <header class="overflow-hidden">
            <div class="top-gradient"></div>
            <div class="container header-wrapper">
                <div class="content-wrapper">
                    <h1 class="main-title">
                        Réserver une consultation chez un professionnel de santé
                    </h1>
                    <div class="">
                        <v-row>
                            <v-col cols="6">
                                <v-text-field
                                    label="Nom, spécialité, établissement..."
                                    placeholder="Nom, spécialité, établissement..."
                                    filled
                                    rounded
                                    dense
                                    large
                                    prepend-icon="mdi-magnify"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="6">
                                <v-text-field
                                    label="Où ?"
                                    placeholder="Adresse"
                                    filled
                                    rounded
                                    dense
                                    large
                                    prepend-icon="mdi-map-marker"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </div>
                    <div class="separator"></div>
                    <a>
                        <button class="buttonCustom">
                            <div class="height-fix">Rechercher</div>
                        </button>
                    </a>
                </div>
            </div>
        </header>
        <section id="resume">
            <v-container>
                <v-row v-for="j in justify" :key="j" :justify="j">
                    <v-col v-for="k in 1" :key="k" md="12">
                        <h2 class="text-center mb-10">
                            Pourquoi prendre rendez-vous avec DoctoCréneau ?
                        </h2>
                    </v-col>
                </v-row>
                <v-row v-for="j in justify" :key="j" :justify="j">
                    <div
                        v-for="card in cards"
                        :key="card.title"
                        class="text-center"
                    >
                        <div class="ml-5 mr-5 card">
                            <img :src="card.img" />
                            <h3>{{ card.title }}</h3>
                            <div class="description">
                                <p>{{ card.description }}</p>
                            </div>
                        </div>
                    </div>
                </v-row>
            </v-container>
        </section>
    </div>
</template>

<script>
export default {
    name: "HomePage",

    data: () => ({
        justify: ["center"],
        cards: [
            {
                img: "https://www.doctolib.fr/webpack/a5e17c72213e53ab835e.png",
                title: "Foo",
                description:
                    "Accédez aux disponibilités de dizaines de milliers de professionnels de santé.",
            },
            {
                img: "https://www.doctolib.fr/webpack/4aa6dbff428e055632e5.png",
                title: "dd",
                description:
                    "Prenez rendez vous en ligne, 24h/24 et 7j/7, pour une consultation physique ou vidéo.",
            },
            {
                img: "https://www.doctolib.fr/webpack/7062ba83984198463022.png",
                title: "dd",
                description:
                    "Recevez des rappels automatiques par SMS ou par email.",
            },
        ],
    }),
};
</script>
