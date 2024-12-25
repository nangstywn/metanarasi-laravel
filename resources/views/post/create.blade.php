@extends('layouts.app')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        .btn {
            border-radius: 0%;
        }

        .form-control {
            border-radius: 0%;

        }
    </style>
@endpush
@section('content')
    <div class="container">

        <div class="row" class="align-middle text-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="display: flex; align-items:center; justify-content:space-between;">
                        <div class="title" align="left">
                            <h3> Kirim Tulisan</h3>
                        </div>
                    </div>
                    <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <div class="input-group mb-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Judul</label>
                                        <input type="text" name="title" id="title" class="form-control"
                                            placeholder="" value="{{ old('title') }}">
                                        <span></span>
                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="col-md-12">
                                        <label class="control-label">Konten</label>
                                        <textarea name="contents" class="form-control" rows="10" cols="20" id="summernote">{{ old('contents') }}</textarea>
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
                                <div class="input-group mb-4">
                                    <div class="col-md-12">
                                        <label for="author" class="control-label">Author</label>
                                        <input type="text" name="author" id="author" class="form-control"
                                            placeholder="" value="{{ old('author') }}">
                                        <span></span>
                                        @error('author')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="input-group mb-4">
                                    <div class="col-md-12">
                                        <label for="email" class="control-label">Email</label>
                                        <input type="text" name="email" id="email" class="form-control"
                                            placeholder="" value="{{ old('email') }}">
                                        <span></span>
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-circle"></i>
                                Submit</button>
                            <a href="{{ route('post.index') }}" class="btn btn-danger">
                                <i class="fa fa-ban"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- </div> --}}
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            console.log(Popper);
            $('#summernote').summernote({
                height: 300, // Set the height of the editor
                toolbar: [
                    // Only include the buttons for headings, fonts, and image
                    ['style', ['bold', 'italic', 'underline', 'strikethrough',
                        'clear'
                    ]], // Font style options
                    ['font', ['fontname', 'fontsize', 'color']], // Font family, size, and color
                    ['para', ['ul', 'ol', 'paragraph',
                        'height'
                    ]], // Paragraph options (including headings)
                    ['insert', ['picture']] // Image insert button
                ],
                popover: {
                    air: false // Disable popovers to avoid the error related to Popper.js
                }
            });
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
            };
        };
        imgUpload();
    </script>
@endpush
