@extends('layouts.master')
@section('title', 'Edit Post')
@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/js/select2/select2.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/js/datetimepicker/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/js/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row" class="align-middle text-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="display: flex; align-items:center; justify-content:space-between;">
                        <div class="title" align="left">
                            <h3> Edit Post</h3>
                        </div>
                    </div>
                    <form action="{{ route('admin.post.update', $post->uuid) }}" method="POST" id="submit"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Judul</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            placeholder="Masukkan Judul" value="{{ old('title') ?? $post->title }}">
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Kategori</label>
                                        <select name="category" class="form-control category"
                                            data-placeholder="Pilih Kategori">
                                            <option value=""></option>
                                            @if (!empty(old('category')))
                                                <option value="{{ old('category') }}" selected>{{ old('category_text') }}
                                                </option>
                                            @else
                                                <option value="{{ $post->category_id }}" selected>
                                                    {{ optional($post->category)->name ?? '-' }}
                                                </option>
                                            @endif
                                        </select>
                                        <input type="hidden" class="category_text" value="{{ old('category_text') }}">
                                        @error('category')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Tag</label>
                                        <select name="tags[]" class="form-control tag" data-placeholder="Pilih Tag"
                                            multiple="multiple">
                                            <option value=""></option>
                                            @if (!empty(old('tags')))
                                                <option value="{{ old('tag') }}" selected>{{ old('tag_text') }}
                                                </option>
                                            @else
                                                @foreach ($post->tags as $item)
                                                    <option value="{{ $item->id }}" selected>{{ $item->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="hidden" class="tag_text" name="tag_text"
                                            value="{{ old('tag_text') }}">
                                        @error('tag')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Konten</label>
                                        <textarea name="contents" class="form-control" rows="10" cols="20" id="summernote">{{ old('contents') ?? $post->content }}</textarea>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="col-md-4">
                                        <div class="form-box">
                                            <label for="">Upload Thumbnail</label>
                                            <div class="d-flex flex-wrap input-image-container">
                                                <label class="image-input withAjax">
                                                    <input type="file" accept="image/png,image/jpeg" max-size="10000000"
                                                        name="attachment">
                                                    <input type="hidden" name="attachment_hidden" class="attachment-hidden"
                                                        value="{{ $post->attachment ?? '' }}">
                                                    <a onclick="removePicture()"
                                                        class="image-removee {{ isset($post->attachment) ? '' : 'd-none' }}">
                                                    </a>
                                                    <img src="{{ $post->attachment_url }}" alt=""
                                                        class="img-preview">
                                                </label>
                                            </div>
                                            {{-- <span class="text-danger"></span> --}}
                                            @error('attachment_hidden')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Status Aktif</label>
                                        <div class="form-check form-switch">
                                            <input type="hidden" name="is_active" value=0>
                                            <input class="form-check-input pick" name="is_active" type="checkbox"
                                                value="1" id="flexSwitchChecked"
                                                {{ $post->is_active == 1 ? 'checked' : '' }} />
                                            <label class="form-check-label" for="flexSwitchChecked">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-dot-circle-o"></i>
                                Submit</button>
                            <button type="reset" class="btn btn-danger">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
@push('scripts')
    <script src="{{ asset('assets/admin/js/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/image-input.js?v=1.5.0') }}"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
        // $('.select2').select2();
        // $('#submit').on('submit', function(e) {
        //     const val = $('.attachment-hidden').val()
        //     // const parent = $(this).parents('.image-input')
        //     const anymore = $('.text-danger')
        //     if (!val) {
        //         anymore.html('<span>Thumbnail wajib diisi</span>')
        //         e.preventDefault()
        //         toastr.error('Validasi Error');
        //         // return false;
        //     }
        //     if (val) {
        //         anymore.html('')
        //     }
        // })


        function removePicture() {
            $('.img-preview').attr('src', '');
            $('.image-removee').addClass('d-none')
            $('.attachment-hidden').val('')

        }
        $(document).ready(function() {
            function imgUpload() {
                document.querySelectorAll('.image-input').forEach($el => {
                    var imageInput = new ImageInput($el);
                    imageInput.afterChanged = afterChanged;
                });

                function afterChanged(file, $el) {
                    $('.attachment-hidden').val(file.name)
                    $('.image-removee').removeClass('d-none')
                    // if (!$el.nextElementSibling) {
                    //     var $remove = document.createElement('button');
                    //     $remove.className = "image-remove";

                    //     var $new = $el.cloneNode(true);
                    //     $new.querySelector('input[type=hidden]').value = "";
                    //     $new.querySelector('input[type=file]').value = "";
                    //     $new.querySelector('img').src = "";

                    //     // $el.parentElement.append($new);
                    //     // $el.append($remove);

                    //     // $('.remove').removeClass('d-none')
                    //     // var imageInput = new ImageInput($new);
                    //     // imageInput.afterChanged = afterChanged;

                    // }
                };
            };
            imgUpload();

            costumSelect2Paginate('...', $('.category'),
                `{{ route('admin.json.category') }}`);
            costumSelect2Paginate('...', $('.tag'),
                `{{ route('admin.json.tag') }}`);
        });
    </script>
@endpush
