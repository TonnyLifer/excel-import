<script setup>
import ListProducts from '../Components/ListProducts.vue';
import CreateProducts from '../Components/CreateProducts.vue';
import { watchEffect } from 'vue';
import {useExcelStore} from '../Store/store'

const store = useExcelStore()

// получаем из локального хранилища данные
const getTableFromLocalStore = () => {
    store.getTableFromLocalStore()
}

watchEffect([getTableFromLocalStore])
</script>
<template>
    <v-app>
        <v-layout>
            <v-app-bar
                color="primary"
                density="compact"
            >
                <v-app-bar-title>Товары</v-app-bar-title>
            </v-app-bar>
            
            <v-main style="background-color: rgb(239, 239, 239);">
                <v-container fluid>
                    <CreateProducts/>
                    <ListProducts/>
                </v-container>
                
            </v-main>
        </v-layout>
    </v-app>
</template>