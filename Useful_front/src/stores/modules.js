import { apiService } from './services';
import { defineStore } from 'pinia';

export const useModuleStore = defineStore('modules', {
  state: () => ({
    modules: null,
    api: apiService,
    error: null
  }),
  actions: {
    async getModules() {

        try {

            const response = await apiService.get('/modules')
            console.log(response)
            if(response.status == 200) {
                this.error = null

                this.modules = response.data
                console.log(this.modules);

            } else {
                this.error = response.data.error
            }
        }catch(error) {
            console.log(error.response.data.message);

            this.error = error.response.data.message
        }
    },


  },
  persist: true,
})
