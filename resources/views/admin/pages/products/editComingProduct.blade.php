@extends('admin.layouts.app')

@section('content')
    <div class="py-3 my-3">
        <h4>Edit produk</h4>
    </div>
    <div class="card">
        <div class="card-body p-4 m-5">
            <form class="form-bookmark needs-validation" action="{{ route('product-coming.update', $comingSoonProduct->id) }}" method="POST" id="bookmark-form"
                novalidate="" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="type" value="company">
                <div class="row g-2">
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="name">Nama Produk</label>
                        <input class="form-control" name="name" id="name" type="text" required
                            placeholder="Contoh: Produk Hummatech" autocomplete="name" value="{{ old('name', $comingSoonProduct->name) }}" />
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="category">Kategori Produk</label>
                        <select name="category_product_id" class="js-example-basic-single form-select" id="#edit">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}"{{ old('category_product_id', $comingSoonProduct->category_product_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @empty
                                <option value="" disabled selected>Kategori Masih Kosong</option>
                            @endforelse
                        </select>
                        @error('category_product_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="description">Deskripsi</label>
                        <textarea rows="5" class="form-control" name="description" id="description" name="description"
                            placeholder="Jelaskan deskripsi produknya">{{ old('name', $comingSoonProduct->description) }}</textarea>
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="link">Link</label>
                        <input class="form-control" id="link" type="url" name="link" required
                            placeholder="Contoh: https://hummatech.com/linknya" value="{{ old('link', $comingSoonProduct->link) }}"/>
                        @error('link')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group mb-3 mt-0 col-md-12">
                        <label for="photo">Foto / Logo Produk</label>
                        <figure class="col-xl-3 col-md-4 col-6" itemprop="associatedMedia" itemscope="">
                            <img class="img-thumbnail" src="{{ asset('storage/'.$comingSoonProduct->image) }}" itemprop="thumbnail">
                        </figure>
                        <input class="form-control" id="photo" type="file" name="image" />
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('product.index') }}" class="btn btn-light-danger mt-2" type="button">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @include('admin.components.delete-modal-component')
@endsection

@section('script')
    <script>
        
    </script>
@endsection
