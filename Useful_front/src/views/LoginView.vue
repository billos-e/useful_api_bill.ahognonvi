<template>
    <form @submit.prevent="login" class="max-w-96 w-full text-center border border-gray-300/60 rounded-2xl px-8 bg-white">
        <h1 class="text-gray-900 text-3xl mt-10 font-medium">Login</h1>
        <p class="text-gray-500 text-sm mt-2">Please sign in to continue</p>
        <p >{{ error }}</p>
        <div class="flex items-center w-full mt-10 bg-white border border-gray-300/80 h-12 rounded-full overflow-hidden pl-6 gap-2">
            <input v-model="form.email" type="email" placeholder="Email" class="bg-transparent text-gray-500 placeholder-gray-500 outline-none text-sm w-full h-full" required>
        </div>

        <div class="flex items-center mt-4 w-full bg-white border border-gray-300/80 h-12 rounded-full overflow-hidden pl-6 gap-2">
            <input v-model="form.password" type="password" min="8" placeholder="Password" class="bg-transparent text-gray-500 placeholder-gray-500 outline-none text-sm w-full h-full" required>
        </div>

        <button type="submit" class="mt-2 w-full h-11 rounded-full text-white bg-indigo-500 hover:opacity-90 transition-opacity">
            Login
        </button>
        <p class="text-gray-500 text-sm mt-3 mb-11">Don’t have an account? <a class="text-indigo-500" href="#">Sign up</a></p>
    </form>
</template>

<script setup>
import { useAuthStore } from '@/stores/auth';
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';

const error = ref('')
const auth = useAuthStore();
const router = useRouter()
const form = reactive({
    email: "",
    password: ""
})

if(auth.token) router.push({'name' : 'home'})

const login = async () => {
    if(!form.email || !form.password || form.email.trim() == '' || form.password.trim() == '' || form.password.length < 8 ) {
        error.value = 'Entrees invalides'
        return
    }
    error.value = 'Chargement...'
    await auth.doLogin(form)

    if (auth.error) {
        error.value = auth.error
    } else {
        error.value = 'Vous êtes connecté'
        router.push({'name' : 'home'})

    }

}
</script>
