<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $products = $this->repository->all();

        return view('products.index', compact('products'));
    }

    public function store(ProductRequest $request)
    {
        $this->repository->store(new Product($request->all()));

        toast('Producto creado', 'success');

        return redirect()->route('products.index');
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->fill($request->all());

        $this->repository->store($product);

        toast('Producto actualizado', 'success');

        return redirect()->route('products.index');
    }

    public function destroy(Product $product)
    {
        $this->repository->delete($product);

        toast('Producto eliminado', 'success');

        return redirect()->route('products.index');
    }

    public function getByName()
    {
        $response = [];
        $search = request()->search;

        $products = $this->repository->getByName($search);

        foreach($products as $product) {
            $response[] = [
                "value" => $product->id,
                "label" => $product->name,
                "unit_price" => $product->unit_price,
            ];
        }

        return response()->json($response);
    }

    public function getProductsByUser(int $userId)
    {
        return Product::where('user_id', $userId)->get();
    }

    function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());

        return ((float)$usec + (float)$sec);
    }
}
