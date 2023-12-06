<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;

class ProductsImport implements  WithHeadingRow, OnEachRow
{
    public function onRow(Row $row)
    {
        Validator::make($row->toArray(), [
            'artikul' => ['required','string'],
            'nomenklatura' => ['required','string'],
            'ed_izm' => ['required','string'],
            'kol' => ['required','string'],
            'cena_za_st' => ['required','string'],
        ])->validate();
        // info(gettype($row['cena_za_st']) == 'integer');

        Product::updateOrCreate(
            // поиск по полю article
            ['article' => $row['artikul']
        ], 
        [
            'name' => $row['nomenklatura'],
            'unit' => $row['ed_izm'],
            'quantity'=> $row['kol'],
            'price'=> $row['cena_za_st']
        ]);
    }

    public function headingRow(): int
    {
        return 1;
    }
}

