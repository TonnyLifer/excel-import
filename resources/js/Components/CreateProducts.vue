<script setup>
import { ref } from 'vue'
import * as XLSX from 'xlsx' 
import {useExcelStore} from '../Store/store'

const file_excel = ref()
const store = useExcelStore()

const upload = () => {
    const productData = new FormData();
    productData.append("excel", file_excel.value[0]);
    store.uploadExcel(productData)
}

const onChange = e => {
    const file = e.target.files[0]
    var reader = new FileReader()
    reader.readAsArrayBuffer(file)
    reader.onload = e => {
        var data = e.target.result

        let workbook = XLSX.read(data, { type: 'binary', cellDates: true  })        
        var wsname = workbook.SheetNames[0]
        var outdata = XLSX.utils.sheet_to_json(workbook.Sheets[wsname])
        
        // получаем данные для таблицы
        store.items = outdata
        store.headers = getHeaderRow(workbook.Sheets[wsname])

        // кладём объекты в локалное хранилище
        const localObject = {
            headers: store.headers,
            items: store.items
        }

        localStorage.setItem('tables', JSON.stringify(localObject))
    }
}
const getHeaderRow = (sheet) => {
        const headers = []
        const range = XLSX.utils.decode_range(sheet['!ref'])
        let C
        const R = range.s.r
        // Проход по 1 ряду
        for (C = range.s.c; C <= range.e.c; ++C) {

            const cell = sheet[XLSX.utils.encode_cell({ c: C, r: R })]
            // находим ячейку
            let hdr = C
            if (cell && cell.t) hdr = XLSX.utils.format_cell(cell)
            headers.push({title: hdr, key: hdr})
        }
        return headers
    }
</script>
<template>
    <div>
        <v-card round="0" variant="elevated" class="mb-3">
            <v-card-text>
                <v-alert color="orange-darken-2" class="ma-3">
                        
                    <p class="font-weight-black text-white">
                        <v-icon>mdi-alert</v-icon>
                        Принимаются только файлы формата .xlsx
                    </p>
                    
                </v-alert>
                <v-row align="center">
                    <v-col cols=12 md="4">
                        <v-file-input
                            accept=".xlsx"
                            show-size
                            v-model="file_excel"
                            hide-details
                            @change="onChange" 
                            prepend-icon="mdi-microsoft-excel"
                            label="Выберите файл"
                            clearable
                            variant="outlined"
                            clear-icon="mdi-close"
                        ></v-file-input>
                    </v-col>
                    <v-col cols=12 md="4">
                        <v-btn 
                            color="green" 
                            prepend-icon="mdi-upload"
                            @click="upload">
                            Загурзить
                        </v-btn>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </div>
</template>