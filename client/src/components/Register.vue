<template><!--Register form using tailwindcss -->
    <div class="flex flex-col items-center justify-center h-screen">
        <div class="w-full max-w-xs">
            <div class="text-center">
                <h1 class="text-2xl font-semibold text-gray-900">
                    Inscription
                </h1>
            </div>
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="register">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Adresse mail
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="username" type="text" placeholder="jean.bernard@mail.com" v-model="username">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Mot de passe
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="password" placeholder="******************" v-model="password">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Confirmer le mot de passe
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="repeatPassword" type="password" placeholder="******************" v-model="password_confirmation">
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                        type="submit" @click="register">
                        S'inscrire
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
export default {
    name: "Register",
}
</script>
<style></style>
