import axios from 'axios'
import { defineStore } from 'pinia'

export const useExcelStore = defineStore('ExcelStore', {
    state: () => ({ 
        items: [],
        headers: []
    }),
    actions:{
        getTableFromLocalStore(){
            let retrievedObject = localStorage.getItem('tables')

            this.items = JSON.parse(retrievedObject).items
            this.headers = JSON.parse(retrievedObject).headers
        },
        uploadExcel(excel){
            axios.post('/api/products/upload', excel).then((result) => {
                console.log(result.data)
            }).catch((err) => {
                console.log(err)
            });
        }
    }
})