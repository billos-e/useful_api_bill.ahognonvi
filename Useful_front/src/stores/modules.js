import { apiService } from './services';
import { defineStore } from 'pinia';

export const useModuleStore = defineStore('counter', {
  state: () => ({
    modules: null,
    api: apiService,
    error: null
  }),
  actions: {
    async getModules() {

        try {

            const response = await apiService.post('/modules')
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


  },
  persist: true,
})
