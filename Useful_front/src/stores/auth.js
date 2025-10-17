import axios from 'axios';
import { defineStore } from 'pinia';


const URL = 'http://127.0.0.1:8000/api'
const apiService = axios.create({
  baseURL: URL,
  headers: {
    // 'Authorization': `Bearer ${authStore.token ?? ''}`,
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  }
});

export const useAuthStore = defineStore('counter', {
  state: () => ({
    currentUser: null,
    token: null,
    api: apiService,
    error: null
  }),
  actions: {
    async doLogin(data) {

        try {

            const response = await apiService.post('/login', data)
            console.log(response)
            if(response.status == 201) {
                this.error = null
                this.token = response.data?.token

                console.log(this.token);
                apiService.defaults.headers.common['Authorization'] = `Bearer ${this.token ?? ''}`;

            } else {
                this.error = response.data.error
            }
        }catch(error) {
            console.log(error.response.data.error);

            this.error = error.response.data.error
        }
    },

    async doLogout() {
        try {

            const response = await apiService.post('/logout')
            console.log(response)
            if(response.status == 200) {
                this.error = null
                this.token = null

                console.log(response.data.message);
                return true;

            } else {
                this.error = response.data.error
            }
        }catch(error) {
            console.log(error.response.data.error);

            this.error = error.response.data.error
        }
    }



  },
  persist: true,
})
