@extends('layouts.master')
@section('title', 'Tambah Post')
@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('assets/admin/js/select2/select2.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/admin/js/datetimepicker/jquery.datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/js/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <style>
        .select2-container--bootstrap5 .select2-selection--multiple:not(.form-select-sm):not(.form-select-lg) .select2-selection__choice .select2-selection__choice__display {
            margin-left: 1.2rem;
            font-size: 1.0rem;
            color: white;
        }

        .select2-container--bootstrap5 .select2-selection--multiple .select2-selection__rendered .select2-selection__choice {
            display: inline-flex;
            align-items: center;
            position: relative;
            background-color: #009EF7;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row" class="align-middle text-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="display: flex; align-items:center; justify-content:space-between;">
                        <div class="title" align="left">
                            <h3> Tambah Post</h3>
                        </div>
                    </div>
                    <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Judul</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            placeholder="Masukkan Judul" value="{{ old('title') }}">
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
                                            @endif
                                        </select>
                                        <input type="hidden" class="category_text" name="category_text"
                                            value="{{ old('category_text') }}">
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
                                                @foreach (old('tags') as $key => $item)
                                                    <option value="{{ $item }}" selected>
                                                        {{ old('tag_text[$key]') }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <input type="hidden" class="tag_text" name="tag_text[]"
                                            value="{{ old('tag_text[]') }}">
                                        @error('tags')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Konten</label>
                                        <textarea name="contents" class="form-control" rows="10" cols="20" id="summernote"></textarea>
                                        @error('contents')
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
                                                    <input type="hidden" name="attachment_hidden"
                                                        class="attachment-hidden">
                                                    <a onclick="removePicture()" class="image-removee d-none">
                                                    </a>
                                                    <img src="" alt="" class="img-preview">
                                                </label>
                                            </div>
                                            @error('attachment_hidden')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
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
    {{-- <script src="{{ asset('assets/admin/js/select2/select2.min.js') }}"></script> --}}
    <script src="{{ asset('assets/admin/js/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });

        function removePicture() {
            $('.img-preview').attr('src', '');
            $('.image-removee').addClass('d-none')
        }

        function imgUpload() {
            document.querySelectorAll('.image-input').forEach($el => {
                var imageInput = new ImageInput($el);
                imageInput.afterChanged = afterChanged;
            });

            function afterChanged(file, $el) {
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

        $('.category').on('select2:select', function(e) {
            $('.category_text').val(e.params.data.text);
        })
        let arr = [];
        $('.tag').on('select2:select', function(e) {
            arr.push(e.params.data.text)
            $('.tag_text').each(function(i) {
                $(this).val(arr[i]);
            })
        })
        // $(".category").select2({
        //     width: 'resolve',
        //     ajax: {
        //         url: "{{ route('admin.json.category') }}",
        //         type: 'GET',
        //         dataType: 'json',
        //         data: function(param) {
        //             return {
        //                 search: param.term
        //             }
        //         },
        //         delay: 250,
        //         processResults: function(data) {
        //             return {
        //                 results: $.map(data, function(item) {
        //                     return item
        //                 })
        //             };
        //         },
        //         cache: true
        //     }
        // });
    </script>
@endpush
