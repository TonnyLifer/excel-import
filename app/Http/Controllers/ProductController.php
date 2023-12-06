<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\ExcelProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Imports\ProductsImport;
use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Services\CreateProductService;
use App\Services\DestroyProductService;
use App\Services\UpdateProductService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    // получение
    public function index(ProductRepository $productRepository, $id = null){
        if($id){
            return $productRepository->getById($id);
        }
        return $productRepository->getAll($id);
    }

    // создание
    public function create(CreateProductRequest $request){
        $data = $request->validated();

        CreateProductService::create($data);

        return response()->json(['msg' => true]);
    }

    // редактирование
    public function update(UpdateProductRequest $request){
        $data = $request->validated();

        UpdateProductService::update($data);

        return response()->json(['msg' => true]);
    }

    // удаление
    public function destroy($id){

        DestroyProductService::delete($id);

        return response()->json(['msg' => true]);
    }

    // импорт
    public function upload(ExcelProductRequest $request){

        $data = $request->validated();

        $excel = Excel::import(new ProductsImport, request()->file('excel'));

        return response()->json(['msg' => true]);
    }
}
