<template>
    <!--Navbar using tailwindcss -->
    <nav class="relative flex flex-wrap items-center justify-between px-2 py-3 bg-indigo-500 mb-3">
        <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
            <div class="w-full relative flex justify-between lg:w-auto  px-4 lg:static lg:block lg:justify-start">
                <router-link to="/"
                             class="px-3 py-2 flex items-center text-xl uppercase font-bold leading-snug text-white hover:opacity-75">
                    FreeDoc
                </router-link>
                <button
                    class="text-white cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                    type="button" v-on:click="toggleNavbar()">
                </button>
            </div>
            <div v-if="isConnected === true" v-bind:class="{'hidden': !showMenu, 'flex': showMenu}"
                 class="lg:flex lg:flex-grow items-center">
                <div class="flex flex-col lg:flex-row list-none ml-auto">
                    <router-link to="/login"
                                 class="px-3 py-2 flex items-center text-xl uppercase font-bold leading-snug text-white hover:opacity-75">
                        <span>Connexion</span>
                    </router-link>
                    <router-link to="/register"
                                 class="px-3 py-2 flex items-center text-xl uppercase font-bold leading-snug text-white hover:opacity-75">
                        <span>Inscription</span>
                    </router-link>
                </div>
            </div>
            <div v-if="isConnected === false" class="lg:flex lg:flex-grow items-center">
                <div class="flex flex-col lg:flex-row list-none ml-auto">
                    <router-link to="/profile"
                                 class="px-3 py-2 flex items-center text-xl uppercase font-bold leading-snug text-white hover:opacity-75">
                        <span>Mon profil</span>
                    </router-link>
                    <router-link to="/rdv"
                                 class="px-3 py-2 flex items-center text-xl uppercase font-bold leading-snug text-white hover:opacity-75">
                        <span class="text-white">Mes réservations</span>
                    </router-link>
                    <router-link to="/logout"
                                 class="px-3 py-2 flex items-center text-xl uppercase font-bold leading-snug text-white hover:opacity-75">
                        <span>Déconnexion</span>
                    </router-link>

                </div>
            </div>
        </div>
    </nav>

</template>
<script>
export default {
    name: "Navbar",
    data() {
        return {
            showMenu: false,
            isConnected: false
        }
    },
    methods: {
        toggleNavbar: function () {
            this.showMenu = !this.showMenu;
        }
    }
}
</script>
<style></style>
