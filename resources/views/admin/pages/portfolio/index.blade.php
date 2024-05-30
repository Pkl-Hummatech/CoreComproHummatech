@extends('admin.layouts.app')

@section('subcontent')
    <div class="d-flex justify-content-between align-items-end pt-4">
        <form action="/admin/portfolio/">
            <div class="col-9">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" name="name" value="{{ request()->name }}" class="form-control"
                    placeholder="Cari Portofolio" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
        </form>
        <div class=" col-8 gap-2 d-flex justify-content-end">
            {{-- <a href="/data/portfolio" class="btn btn-secondary col-4" target="_blank">Lihat Portfolio</a> --}}
            <button data-bs-target="#add" data-bs-toggle="modal" class="btn btn-primary">Tambah Portofolio</button>
        </div>
    </div>
@endsection

@section('content')
    <div class="row py-5">
        @forelse ($portfolios as $portfolio)
            <div class="col-lg-3">
                <div class="card border-0 shadow rounded">
                    <img src="{{ asset('storage/' . $portfolio->image) }}" alt="{{ $portfolio->name }}"
                        style="object-fit: cover; width: 100%; height: 200px" class="rounded-top card-img-thumbnail" />
                    <div class="card-header text-center h4 border-bottom"
                        style="margin-top: -1rem; border-radius: var(--bs-border-radius) var(--bs-border-radius) 0 0 !important;">
                        {{ $portfolio->name }}</div>
                    <div class="card-body">
                        <p>{{ Str::limit($portfolio->description, 80) }}</p>

                        <div class="gap-2 d-flex">
                            <div class="d-grid flex-grow-1">
                                <button data-id="{{ $portfolio->id }}" 
                                    data-name="{{ $portfolio->name }}" 
                                    data-category="{{ $portfolio->CategoryProduct->name }}" 
                                    data-description="{{ $portfolio->description }}" 
                                    data-link="{{ $portfolio->link }}" 
                                    data-image="{{ asset('storage/'. $portfolio->image) }}" 
                                    data-bs-target="#detail" 
                                    data-bs-toggle="modal" class="btn btn-light-primary btn-mini btn-detail">Lihat Detail</button>
                            </div>
                            <div class="d-flex flex-shrink-0 gap-2">
                                <button class="btn btn-light-warning px-3 m-0 btn-edit"
                                data-id="{{ $portfolio->id }}" 
                                    data-name="{{ $portfolio->name }}" 
                                    data-category="{{ $portfolio->CategoryProduct->name }}" 
                                    data-category-id="{{ $portfolio->category_product_id }}" 
                                    data-description="{{ $portfolio->description }}" 
                                    data-link="{{ $portfolio->link }}" 
                                    data-image="{{ asset('storage/'. $portfolio->image) }}">
                                    <i class="fas fa-pencil"></i>
                                </button>
                                <button class="btn btn-light-danger px-3 m-0 btn-delete" type="button"
                                    data-id="{{ $portfolio->id }}"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="d-flex justify-content-center">
                <img src="{{ asset('nodata.jpg') }}" alt="" width="400px">
            </div>
            <h5 class="text-center">
                Data Masih Kosong
            </h5>
        @endforelse
    </div>

    <div class="modal fade modal-bookmark" id="detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content px-2">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title me-2" id="exampleModalLabel">Detail Portofolio</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-12 d-flex justify-content-between" id="detail-content">
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button class="purchase-btn btn btn-hover-effect btn-light-danger text-white f-w-500" type="button" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-bookmark" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content px-2">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title me-2" id="exampleModalLabel">Portofolio Baru</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <form action="{{ route('portfolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="d-flex gap-4">
                            <div class="form-group mb-3 mt-0 col-md-8">
                                <label for="name">Judul Portofolio</label>
                                <input class="form-control" name="name" id="name" type="text" required
                                    placeholder="Judul portfolio" autocomplete="name" />
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3 mt-0 w-50">
                                <label for="category">Kategori Portofolio</label>
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
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="description">Deskripsi</label>
                            <textarea rows="5" class="form-control" name="description" id="description" name="description"
                                placeholder="Jelaskan deskripsi portofolionya"></textarea>
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
                            <label for="photo">Foto Portofolio</label>
                            <input class="form-control" id="photo" type="file" name="image" />
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button class=" btn btn-hover-effect btn-secondary text-white f-w-500" type="button" data-bs-dismiss="modal">Tutup</button>
                        <button class="purchase-btn btn btn-hover-effect text-white f-w-500" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    <div class="modal fade modal-bookmark" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content px-2">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title me-2" id="exampleModalLabel">Edit Portofolio</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <form method="POST" id="form-edit" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="d-flex gap-4">
                            <div class="form-group mb-3 mt-0 col-md-8">
                                <label for="name">Judul Portofolio</label>
                                <input class="form-control" name="name" id="name-edit" type="text" required
                                    placeholder="Judul portfolio" autocomplete="name" />
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3 mt-0 w-50">
                                <label for="category">Kategori Portofolio</label>
                                <select name="category_product_id" class="js-example-basic-single form-select" id="categoryEdit">
                                    <option value="" disabled>Pilih Kategori</option>
                                    @forelse ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @empty
                                        <option value="" disabled>Kategori Masih Kosong</option>
                                    @endforelse
                                </select>
                                @error('category_product_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="description">Deskripsi</label>
                            <textarea rows="5" class="form-control" name="description" id="description-edit" name="description"
                                placeholder="Jelaskan deskripsi portofolionya"></textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="link">Link</label>
                            <input class="form-control" id="link-edit" type="url" name="link" required
                                placeholder="Contoh: https://hummatech.com/linknya" />
                            @error('link')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-0 col-md-12">
                            <label for="photo">Foto Portofolio</label>
                            <input class="form-control" id="photo-edit" type="file" name="image" />
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button class=" btn btn-hover-effect btn-secondary text-white f-w-500" type="button" data-bs-dismiss="modal">Tutup</button>
                        <button class="purchase-btn btn btn-hover-effect text-white f-w-500" type="submit">Simpan</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    @include('admin.components.delete-modal-component')
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'OK',
                timer: 2000, // Menutup SweetAlert setelah 3 detik
                timerProgressBar: true // Menampilkan progress bar
            });
        </script>
    @endif
    <script>
         $('.btn-detail').click(function() {
            var detail = $('#detail-content');
            detail.empty();
            var id = $(this).data('id');
            var name = $(this).data('name'); 
            var category = $(this).data('category'); 
            var link = $(this).data('link'); 
            var description = $(this).data('description'); 
            var image = $(this).data('image');

            detail.append('<div class="left col-8"> <h2>'+name+'</h2> <p class="text-primary">'+link+'</p> <p class="text-muted">Kategori: '+category+'</p> <div class="my-1"> <p>'+description+'</p> </div> </div> <div class="right col-4"> <img src="'+image+'" class=" w-100" </div>');
            $('#detail').modal('show');
        });

        $('.btn-edit').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name'); 
            var category = $(this).data('category'); 
            var categoryId = $(this).data('category-id'); 
            var link = $(this).data('link'); 
            var description = $(this).data('description'); 
            var image = $(this).data('image');
            console.log(id);

            $('#name-edit').val(name);
            $('#link-edit').val(link);
            $('#description-edit').val(description);
            $('#image-edit').val(image);
            $('#categoryEdit').val(categoryId).trigger('change');
            $('#form-edit').attr('action', '/admin/portfolio/update/' + id);
            $('#modal-edit').modal('show');
        });
        
        $('.btn-delete').on('click', function() {
            var id = $(this).data('id');
            $('#form-delete').attr('action', '/admin/portfolio/' + id);
            $('#modal-delete').modal('show');
        });
    </script>

    <script>
        function previewImage(event) {
            var input = event.target;
            var previewImage = document.getElementById('image-edit');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script>
        function preview(event) {
            var input = event.target;
            var previewImage = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        const deleteElement = (id) => $('#' + id).remove();

        $('.add-button-trigger').click((e) => {
            let idInput = 'input_' + Math.random().toString(36).substr(2, 9); // Generate random id
            let target = $(e.target).parents('.modal').find('#product-listing');
            target.append(`<div class="d-flex align-items-center mt-3 gap-2" id="${idInput}">
                <input class="form-control" type="text" name="fiturs[]" autocomplete="name" placeholder="Jelaskan fitur Portfolionya" />
                <button onclick="deleteElement('${idInput}')" type="button" class="btn delete-trigger px-3 mt-0 btn-danger"><i
                        class="fas fa-trash"></i></button>
            </div>`);
        });

        $('.btn-close').click((e) => {
            let target = $(e.target).parent('.modal').find('.delete-trigger');
            target.each((i, el) => $(el).click());
        });
    </script>
@endsection
