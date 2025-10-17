<template>
    <button @click="logout">logout</button>
    <p>
        {{ mes }}
    </p>

</template>

<script setup>
import { useAuthStore } from '@/stores/auth';
import { useModuleStore } from '@/stores/modules';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

const auth = useAuthStore();
const moduleStore = useModuleStore();
const mes = ref('')
const router = useRouter();

if(!auth.token) router.push({'name' : 'login'})

const logout = async () => {
    const response = await auth.doLogout();
    if(response){
        mes.value = 'Deconnecté. Redirection...';
        setTimeout(function() {
            router.push({'name': 'login'})
        }, 4000);
    } else {
        mes.value = auth.error || 'Erreur lors de la déconnection'
    }
}

onMounted(async () => {
    await moduleStore.getModules()
})
</script>
