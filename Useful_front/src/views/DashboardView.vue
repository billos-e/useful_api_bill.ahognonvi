<template>
    <button @click="logout">logout</button>
    <p>
        {{ mes }}
    </p>

</template>

<script setup>
import { useAuthStore } from '@/stores/auth';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const auth = useAuthStore();
const mes = ref('')
const router = useRouter();

const logout = async () => {
    const response = await auth.doLogout();
    if(response){
        mes.value = 'Deconnecté. Redirection...';
        setTimeout(function() {
            router.push({'name': 'login'})
        }, 4000);
    }
}
</script>
