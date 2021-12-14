<style scoped lang="scss">
footer {
    background: #22bff3;
    .container {
        max-width: 1390px;
    }

    h3 {
        color: white;
    }

    p {
        color: white;
    }

    .linewhite {
        border-left: 2px solid white;
        height: 240px;
    }

    @media (max-width: 1199.98px) {
        .row {
            margin-top: 15%;
        }
        .footer-card {
            margin-bottom: 15%;
        }

        .cards-footer {
            margin-bottom: 15%;
        }
    }
}
</style>
<template>
    <footer>
        <v-container>
            <div class="d-flex justify-space-around mb-6" flat tile>
                <p v-for="n in 1" :key="n" class="pa-2">
                    DoctoCréneau - Tout droit réservés
                </p>
            </div>
        </v-container>
    </footer>
</template>

<script>
export default {
    name: "Footer",
};
</script>
