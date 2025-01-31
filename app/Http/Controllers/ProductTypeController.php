<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ดึงข้อมูลสินค้าทั้งหมดพร้อมประเภทสินค้า
        $products = Product::with('productType')->get();

        // Return JSON Data & success status
        return response()->json([
            'status' => 'success',
            'data' => $products->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'product_type' => $product->product_type,
                    'amount' => $product->amount,
                    'photo' => $product->photo,
                    'confirmed' => $product->confirmed,
                    'votes' => $product->votes,
                    'created_at' => $product->created_at,
                    'updated_at' => $product->updated_at,
                    'product_type_data' => [
                        'id' => $product->productType->id,
                        'name' => $product->productType->name,
                        'created_at' => $product->productType->created_at,
                        'updated_at' => $product->productType->updated_at,
                    ],
                ];
            }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductType $productType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductType $productType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductType $productType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductType $productType)
    {
        //
    }
}
