<?php

namespace App\Services;

use App\Models\Product;

class DestroyProductService {

    public static function delete($id): void{
        Product::destroy($id);
    }
}