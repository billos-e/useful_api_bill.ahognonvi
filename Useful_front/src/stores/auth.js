import { apiService, removeToken, setToken } from './services';
import { defineStore } from 'pinia';

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

                // console.log(this.token);
                setToken(this.token)

            } else {
                this.error = response.data.error
            }
        }catch(error) {
            console.log(error.response.data.message);

            this.error = error.response.data.message
        }
    },

    async doRegister(data) {

        try {

            const response = await apiService.post('/register', data)
            if(response.status == 201) {
                this.error = null

            } else {
                this.error = response.data.error
            }
        }catch(error) {
            console.log(error.response.data.message);

            this.error = error.response.data.message
        }
    },

    async doLogout() {
        try {

            // console.log(this.token)
            const response = await apiService.post('/logout')
            if(response.status == 200) {
                this.error = null
                this.token = null
                removeToken()

                console.log(response.data.message);
                return true;

            } else {
                this.error = response.data.error
            }
        }catch(error) {
            console.log(error);

            this.error = error.response.data.message
        }
    }



  },
  persist: true,
})
