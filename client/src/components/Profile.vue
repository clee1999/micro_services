<template>
    <!--Profile card using tailwindcss -->
    <div class="flex ">
        <div class="flex ">
            <img :src="user.avatar" alt="avatar" class="rounded-full w-32 h-32  ml-4 mr-4">
        </div>
        <div class="flex-auto">
            <h2 class="font-bold text-xl mt-4 mb-4">{{ user.name }}</h2>
            <p class="text-gray-700 text-base">{{ user.email }}</p>
        </div>
    </div>
</template>
<script>
import * as axios from "core-js";

export default {
    name: 'Profile',
    data() {
        return {
            user: {
                name: 'Rajesh Kumar',
                email: 'rajish.kumar@tempmail.com',
                avatar: 'https://icons.iconarchive.com/icons/diversity-avatars/avatars/1024/indian-man-icon.png'
            }
        }
    },
    created() {
        this.getUser();
    },
    methods: {
        getUser() {
            axios.get('/api/user/$id')
                .then(response => {
                    this.user = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
}
</script>
<style scoped></style>
