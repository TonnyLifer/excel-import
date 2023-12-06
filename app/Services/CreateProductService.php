<?php

namespace App\Services;

use App\Models\Product;

class CreateProductService {

    public static function create($data): void{
        Product::create([
            'article' => $data['artikul'],
            'name' => $data['nomenklatura'],
            'unit' => $data['ed_izm'],
            'quantity'=> $data['kol'],
            'price'=> $data['cena_za_st']
        ]);
    }
}