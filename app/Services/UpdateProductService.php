<?php

namespace App\Services;

use App\Models\Product;

class UpdateProductService {

    public static function update($data): void{
        Product::where('id', $data['id'])->update([
            'article' => $data['artikul'],
            'name' => $data['nomenklatura'],
            'unit' => $data['ed_izm'],
            'quantity'=> $data['kol'],
            'price'=> $data['cena_za_st']
        ]);
    }
}