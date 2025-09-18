<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('pages.categories.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        return view('pages.categories.create');
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        try {
            $this->categoryService->createCategory($request);
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal menambahkan kategori: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);
        return view('pages.categories.edit', compact('category'));
    }

    /**
     * Memperbarui data kategori di database.
     */
    public function update(Request $request, $id)
    {
        try {
            $this->categoryService->updateCategory($request, $id);
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal memperbarui kategori: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Menghapus kategori dari database.
     */
    public function destroy($id)
    {
        try {
            $this->categoryService->deleteCategory($id);
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
        } catch (\Exception $e) {
            // Mengirimkan pesan error spesifik ke view jika kategori gagal dihapus
            return redirect()->route('categories.index')->with('error', $e->getMessage());
        }
    }
}