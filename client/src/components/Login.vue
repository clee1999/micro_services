<template> <!--vue login using tailwindcss-->
    <div class="flex flex-col items-center justify-center h-screen">
        <div class="bg-white shadow-lg rounded-lg px-8 pt-6 pb-8 mb-4">
            <div class="flex flex-col items-center">

                <div class="text-center">
                    <h1 class="text-2xl font-semibold text-gray-900">
                        Connexion
                    </h1>
                </div>

                <div class="w-full mt-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Adresse mail
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        id="email" type="email" placeholder="jean.bernard@mail.com" v-model="email">
                </div>
                <div class="w-full mt-4 mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Mot de passe
                    </label>
                    <input
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                        id="password" type="password" placeholder="******************" v-model.trim="password"/>
                </div>
                <div class="flex items-center justify-between">
                    <button>
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold pt-2 py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                           @click="login">
                            Connexion
                        </a>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Login",
}

</script>
<style>

</style>
