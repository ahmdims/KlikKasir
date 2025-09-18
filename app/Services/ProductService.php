<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductService
{
    /**
     * Mengambil semua produk dengan paginasi.
     */
    public function getAllProducts()
    {
        return Product::with('category')->latest()->paginate(10);
    }

    /**
     * Mengambil produk berdasarkan ID.
     */
    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    /**
     * Membuat produk baru.
     */
    public function createProduct(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        DB::transaction(function () use ($validatedData) {
            Product::create($validatedData);
        });
    }

    /**
     * Memperbarui produk yang ada.
     */
    public function updateProduct(Request $request, $id)
    {
        $product = $this->getProductById($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        DB::transaction(function () use ($product, $validatedData) {
            $product->update($validatedData);
        });
    }

    /**
     * Menghapus produk.
     */
    public function deleteProduct($id)
    {
        $product = $this->getProductById($id);

        DB::transaction(function () use ($product) {
            $product->delete();
        });
    }
}