@extends('admin.layouts.app')

@section('content')
    <div class="py-3 my-3">
        <h4>Tambah produk</h4>
    </div>
    <div class="card">
        <div class="card-body p-4 m-5">
                <ul class="simple-wrapper nav nav-tabs modal-header justify-content-between" id="myTab" role="tablist">
                    <div class="d-flex">
                        <li class="nav-item"><a class="nav-link active txt-primary" id="profile-tabs" data-bs-toggle="tab" href="#organisasi" role="tab" aria-controls="profile" aria-selected="false">Produk</a></li>
                        <li class="nav-item"><a class="nav-link txt-primary" id="contact-tab" data-bs-toggle="tab" href="#usaha" role="tab" aria-controls="contact" aria-selected="false">Produk layanan</a></li>
                        <li class="nav-item"><a class="nav-link txt-primary" id="soon-tab" data-bs-toggle="tab" href="#soon" role="tab" aria-controls="soon" aria-selected="false">Produk coming soon</a></li>
                    </div>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active py-5" id="organisasi" role="tabpanel">
                        <form class="form-bookmark needs-validation" action="{{ route('productCompany.store') }}" method="POST" id="bookmark-form"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="company">
                            <div class="row g-2">
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="name">Nama Produk</label>
                                    <input class="form-control" name="name" id="name" type="text" required
                                        placeholder="Contoh: Produk Hummatech" autocomplete="name" />
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="category">Kategori Produk</label>
                                    <select name="category_product_id" class="js-example-basic-single form-select" id="#edit">
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        placeholder="Jelaskan deskripsi produknya"></textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="feature">Fitur <small class="text-danger">* Masukan fitur produk</small></label>
                                    <div class="d-flex align-items-center mt-3 gap-2">
                                        <input class="form-control m-0" type="text" name="feature[]" autocomplete="name"
                                            placeholder="Masukan Fitur" />
                                    </div>
                                    <div id="product-listing"></div>
                                    @error('title.*')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <button type="button" class="btn add-fitur btn-primary mt-3">Tambah Fitur</button>
                                </div>
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="link">Link</label>
                                    <input class="form-control" id="link" type="url" name="link" required
                                        placeholder="Contoh: https://hummatech.com/linknya" />
                                    @error('link')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="photo">Foto / Logo Produk</label>
                                    <input class="form-control" id="photo" type="file" name="image" />
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('product.index') }}" class="btn btn-light-danger mt-2 text-danger" style="padding: 10px 20px;" type="button">Kembali</a>
                                <button class="btn btn-primary" type="submit">Tambah</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade py-5" id="usaha" role="tabpanel" aria-labelledby="contact-tab">
                        <form class="form-bookmark needs-validation" action="{{ route('product.store') }}" method="POST" id="bookmark-form"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="service">
                            <div class="row g-2">
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="name">Nama Produk</label>
                                    <input class="form-control" name="name" id="name" type="text" required
                                        placeholder="Contoh: Produk Hummatech" autocomplete="name" />
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="category">Kategori Produk</label>
                                    <select name="category_product_id" class="js-example-basic-single form-select" id="#edit">
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        placeholder="Jelaskan deskripsi produknya"></textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="feature">Fitur <small class="text-danger">* Masukan Judul Fitur Beserta
                                            Deskripsi</small></label>
                                    <div class="d-flex align-items-center mt-3 gap-2">
                                        <input type="text" name="title[]" id="" class="form-control"
                                            placeholder="Masukan Judul Fitur">
                                        <input class="form-control m-0" type="text" name="feature[]" autocomplete="name"
                                            placeholder="Masukan Deskripsi Fitur" />
                                    </div>
                                    <div id="product-listing"></div>
                                    @error('feature.*')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    @error('title.*')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <button type="button" class="btn add-button-trigger btn-primary mt-3">Tambah Fitur</button>
                                </div>
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="link">Link</label>
                                    <input class="form-control" id="link" type="url" name="link" required
                                        placeholder="Contoh: https://hummatech.com/linknya" />
                                    @error('link')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="">Tampilkan di</label>
                                    <select name="service_id" class="js-example-basic-single form-select" id="#edit">
                                        <option value="" disabled selected>Pilih Layanan</option>
                                        @forelse ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @empty
                                            <option value="" disabled selected>Layanan Masih Kosong</option>
                                        @endforelse
                                    </select>
                                    @error('service_id')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="photo">Foto / Logo Produk</label>
                                    <input class="form-control" id="photo" type="file" name="image" />
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('product.index') }}" class="btn btn-light-danger mt-2 text-danger" style="padding: 10px 20px;" type="button">Kembali</a>
                                <button class="btn btn-primary" type="submit">Tambah</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade py-5" id="soon" role="tabpanel" aria-labelledby="contact-tab">
                        <form class="form-bookmark needs-validation" action="{{ route('product-coming.store') }}" method="POST" id="bookmark-form"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="type" value="service">
                            <div class="row g-2">
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="name">Nama Produk</label>
                                    <input class="form-control" name="name" id="name" type="text" required
                                        placeholder="Contoh: Produk Hummatech" autocomplete="name" />
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="category">Kategori Produk</label>
                                    <select name="category_product_id" class="js-example-basic-single form-select" id="#edit">
                                        <option value="" disabled selected>Pilih Kategori</option>
                                        @forelse ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        placeholder="Jelaskan deskripsi produknya"></textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="link">Link</label>
                                    <input class="form-control" id="link" type="url" name="link" required
                                        placeholder="Contoh: https://hummatech.com/linknya" />
                                    @error('link')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 mt-0 col-md-12">
                                    <label for="photo">Foto / Logo Produk</label>
                                    <input class="form-control" id="photo" type="file" name="image" />
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('product.index') }}" class="btn btn-light-danger mt-2 text-danger" style="padding: 10px 20px;" type="button">Kembali</a>
                                <button class="btn btn-primary" type="submit">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const deleteElement = (id) => $('#' + id).remove();

        (() => {
            $('.add-fitur').click((e) => {
                let idInput = 'input_' + Math.random().toString(36).substr(2, 9); // Generate random id
                let target = $(e.target).parent().find('#product-listing');
                target.append(`<div class="d-flex align-items-center mt-3 gap-2" id="${idInput}">
                                    <input class="form-control mb-0" type="text" name="feature[]"
                                        required="" autocomplete="name"
                                        placeholder="Masukan Fitur" />
                                    <button onclick="deleteElement('${idInput}')" type="button" class="btn delete-trigger px-3 mt-0 btn-danger"><i
                                            class="fas fa-trash"></i></button>
                                </div>`);
            });

            $('.add-button-trigger').click((e) => {
                let idInput = 'input_' + Math.random().toString(36).substr(2, 9); // Generate random id
                let target = $(e.target).parent().find('#product-listing');
                target.append(`<div class="d-flex align-items-center mt-3 gap-2" id="${idInput}">
                <input class="form-control mb-0" type="text" name="title[]"
                    required="" autocomplete="name"
                    placeholder="Masukan Judul Fitur" />
                <input class="form-control mb-0" type="text" name="feature[]"
                    required="" autocomplete="name"
                    placeholder="Masukan Deskripsi Fitur" />
                <button onclick="deleteElement('${idInput}')" type="button" class="btn delete-trigger px-3 mt-0 btn-danger"><i
                        class="fas fa-trash"></i></button>
                </div>`);
            });

            $('.btn-close').click((e) => {
                let target = $(e.target).parent('.modal').find('.delete-trigger');
                target.each((i, el) => $(el).click());
            });
        })();
    </script>
    <script>
        $(document).ready(function() {
            $(".js-example-basic-single").select2({
                dropdownParent: $("#usaha")
            });
        });
        $(document).ready(function() {
            $(".js-example-basic-single").select2({
                dropdownParent: $("#soon")
            });
        });

    </script>

@endsection
