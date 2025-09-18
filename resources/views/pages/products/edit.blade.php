@extends('layouts.app')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-xxl" id="kt_content_container">
            <form id="kt_ecommerce_edit_product_form" class="form d-flex flex-column flex-lg-row"
                action="{{ route('products.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Edit Produk</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="mb-10 fv-row">
                                <label class="required form-label">Nama Produk</label>
                                <input type="text" name="name" class="form-control mb-2" placeholder="Nama produk"
                                    value="{{ old('name', $product->name) }}" />
                                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-10 fv-row">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" class="form-control mb-2"
                                    placeholder="Deskripsi produk">{{ old('description', $product->description) }}</textarea>
                                @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-10 fv-row">
                                <label class="required form-label">Harga</label>
                                <input type="number" name="price" class="form-control mb-2" placeholder="Harga"
                                    value="{{ old('price', $product->price) }}" />
                                @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-10 fv-row">
                                <label class="required form-label">Stok</label>
                                <input type="number" name="stock" class="form-control mb-2" placeholder="Stok"
                                    value="{{ old('stock', $product->stock) }}" />
                                @error('stock') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-10 fv-row">
                                <label class="required form-label">Kategori</label>
                                <select name="category_id" class="form-select mb-2" data-control="select2"
                                    data-placeholder="Pilih kategori">
                                    <option></option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('products.index') }}" id="kt_ecommerce_edit_product_cancel"
                            class="btn btn-light me-5">Batal</a>
                        <button type="submit" id="kt_ecommerce_edit_product_submit" class="btn btn-primary">
                            <span class="indicator-label">Simpan Perubahan</span>
                            <span class="indicator-progress">Harap tunggu...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection