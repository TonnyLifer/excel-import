<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Row;

class ProductsImport implements ToModel, WithBatchInserts, WithUpserts, WithHeadingRow
{
    public function model(array $row)
    {
        Product::updateOrCreate(
            [
                'article' => $row['artikul']
            ],
            [
                'name' => $row['nomenklatura'],
                'unit' => $row['ed_izm'],
                'quantity'=> gettype($row['kol']) == 'double' ? $row['kol'] : 0,
                'price'=> gettype($row['cena_za_st']) == 'double' ? $row['cena_za_st'] : 0
            ]
        );
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function uniqueBy()
    {
        return 'article';
    }    
}

