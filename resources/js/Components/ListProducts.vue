<script setup>
import { ref } from 'vue'
import {useExcelStore} from '../Store/store'

const store = useExcelStore()
const search = ref()

</script>
<template>
    <v-card round="0" variant="elevated">
        <v-row class="pa-3">
            <v-col cols="12" md="3">
                <v-text-field 
                    variant="outlined"
                    density="compact"
                    v-model="search"
                    clear-icon="mdi-close"
                    clearable
                    label="Поиск"
                ></v-text-field>
            </v-col>
        </v-row>
        <v-data-table
            :headers="store.headers"
            :search="search"
            no-data-text='Нет данных'
            :items="store.items"
        ></v-data-table>
    </v-card>
</template>