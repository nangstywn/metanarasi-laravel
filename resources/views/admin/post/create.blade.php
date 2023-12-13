@extends('layouts.master')
@section('title', 'Tambah Kategori')
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
                                            @if (!empty(old('tag')))
                                                <option value="{{ old('tag') }}" selected>{{ old('category_text') }}
                                                </option>
                                            @endif
                                        </select>
                                        <input type="hidden" class="tag_text" value="{{ old('tag_text') }}">
                                        @error('tag')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Konten</label>
                                        <textarea name="contents" class="form-control" rows="10"></textarea>
                                        @error('content')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="col-md-4">
                                        <label class="control-label">Thumbnail</label>
                                        <input type="file" name="attachment" class="form-control">
                                        @error('attachment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
        // $('.select2').select2();
        costumSelect2Paginate('...', $('.category'),
            `{{ route('admin.json.category') }}`);
        costumSelect2Paginate('...', $('.tag'),
            `{{ route('admin.json.tag') }}`);
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
