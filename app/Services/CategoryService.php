<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    /**
     * Mengambil semua kategori dengan paginasi.
     */
    public function getAllCategories()
    {
        return Category::latest()->paginate(10);
    }

    /**
     * Mengambil kategori berdasarkan ID.
     */
    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Membuat kategori baru.
     */
    public function createCategory(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        DB::transaction(function () use ($validatedData) {
            Category::create($validatedData);
        });
    }

    /**
     * Memperbarui kategori yang ada.
     */
    public function updateCategory(Request $request, $id)
    {
        $category = $this->getCategoryById($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        DB::transaction(function () use ($category, $validatedData) {
            $category->update($validatedData);
        });
    }

    /**
     * Menghapus kategori.
     */
    public function deleteCategory($id)
    {
        $category = $this->getCategoryById($id);

        // Mencegah penghapusan jika kategori masih memiliki produk
        if ($category->products()->exists()) {
            throw new \Exception('Kategori ini tidak dapat dihapus karena masih memiliki produk terkait.');
        }

        DB::transaction(function () use ($category) {
            $category->delete();
        });
    }
}