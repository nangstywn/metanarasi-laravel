@extends('layouts.master')
@section('title', 'Post')
@php
    use Illuminate\Support\Str;
    use App\Constant\Status;
    use App\Constant\IsActive;
@endphp
@section('content')
    <style>
        .table td {
            vertical-align: middle;
        }
    </style>
    <div id="kt_content_container" class="container-xxl">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header" style="display: flex; align-items:center; justify-content:space-between;">
                        <h1 class="text-dark">Post List</h1>
                    </div>

                    <div class="card-body pt-0">
                        <div class="row mb-3">
                            <div class="col">
                                <div class=""
                                    style="display: flex; align-items:center; justify-content:space-between;">
                                    <a href="{{ route('admin.post.create') }}"class="btn btn-sm btn-primary"><i
                                            class="fa fa-plus-circle"></i>Tambah</a>
                                    <form action="">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <div class="col pl-0" style="width: 200px">
                                                <select name="category" class="form-select category" data-control="select2"
                                                    data-allow-clear="true" data-placeholder="Pilih Kategori ...">
                                                    <option value=""></option>
                                                    @if (Request::has('category'))
                                                        <option value="{{ Request::get('category') }}" selected>
                                                            {{ Request::get('category_text') }}</option>
                                                    @else
                                                        <option value=""></option>
                                                    @endif
                                                </select>
                                                <input type="hidden" name="category_text" class="category_text"
                                                    value="{{ Request::get('category_text') }}">
                                            </div>
                                            <div class="col pl-0" style="width: 200px">
                                                <select name="status" class="form-select" data-control="select2"
                                                    data-allow-clear="true" data-placeholder="Pilih Status ...">
                                                    <option value=""></option>
                                                    @foreach (Status::labels() as $key => $val)
                                                        <option value="{{ $key }}"
                                                            {{ Request::get('status') == $key ? 'selected' : '' }}>
                                                            {{ $val }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="category_text" class="category_text"
                                                    value="{{ Request::get('category_text') }}">
                                            </div>
                                            <div class="col pl-0" style="max-width: 200px">
                                                <input type="text" name="q" value="{{ Request::get('q') }}"
                                                    class="form-control" placeholder="Cari Judul">
                                            </div>

                                            <button class="btn btn-sm btn-primary ml-2" type="submit">
                                                <i class="fa fa-filter"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- @if ($message = Session::get('success'))
                        <div class="alert alert-success"><span class="fa fa-check-circle"></span>
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                        <div class="row">
                            <div class="col">
                                <div class="table-outer shadow-sm p-3 mb-5 bg-white ">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-row-bordered gs-7" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th width="30px"></th>
                                                    <th>Judul</th>
                                                    <th>Kategory</th>
                                                    <th>Favourite</th>
                                                    <th>Editor Pick</th>
                                                    <th>Status</th>
                                                    <th>Is Active</th>
                                                    <th>Thumbnail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($posts as $post)
                                                    <tr>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="#" class="btn btn-sm btn-success delete"
                                                                    id="approve" data-id="{{ $post->uuid }}"><i
                                                                        class="fa
                                                                    fa-check"></i></a>
                                                                <a href="{{ route('admin.post.edit', $post->uuid) }}"
                                                                    class="btn btn-sm btn-warning"><i
                                                                        class="fa fa-edit"></i></a>
                                                                <a href="#" class="btn btn-sm btn-danger"
                                                                    id="delete" data-id="{{ $post->uuid }}"><i
                                                                        class="fa fa-trash"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>{{ $post->title ?? '-' }}</td>
                                                        {{-- <td>{!! Str::limit($post->content, 200) ?? '-' !!}</td> --}}
                                                        <td>{{ optional($post->category)->name ?? '-' }}</td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input checkbox" name="favourite"
                                                                    type="checkbox" id="flexSwitchChecked"
                                                                    {{ $post->favourite == 1 ? 'checked' : '' }} />
                                                                <label class="form-check-label" for="flexSwitchChecked">
                                                                </label>
                                                                <input type="hidden" name="post_id" class="post_id"
                                                                    value="{{ $post->id }}">
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input pick" name="pick"
                                                                    type="checkbox" id="flexSwitchChecked"
                                                                    {{ $post->editor_pick == 1 ? 'checked' : '' }} />
                                                                <label class="form-check-label" for="flexSwitchChecked">
                                                                </label>
                                                                <input type="hidden" name="post_id" class="post_id"
                                                                    value="{{ $post->id }}">
                                                            </div>
                                                        </td>
                                                        <td>{!! Status::toHTML($post->status) !!}</td>
                                                        <td>{!! IsActive::toHTML($post->is_active) !!}</td>
                                                        <td><img src="{{ $post->attachment_url }}" height="100"
                                                                width="100" alt="">
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">Tidak ada data</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-md-12">
                                                {!! $posts->links() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $('.checkbox').each(function(e) {
                $(this).change(function(e) {
                    let url = "{{ route('admin.json.update-post') }}"
                    let val, id;
                    if ($(this).is(':checked')) {
                        val = 1
                        id = $(this).parent().find('.post_id').val()
                        url = url.replace(':uuid', id);
                    } else {
                        val = 0
                        id = $(this).parent().find('.post_id').val()
                        url = url.replace(':uuid', id);
                    }
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            favourite: val,
                            id: id
                        },
                        success: function(response) {}
                    });
                })
            });

            $('.pick').each(function(e) {
                $(this).change(function(e) {
                    let url = "{{ route('admin.json.update-post') }}"
                    let val, id;
                    if ($(this).is(':checked')) {
                        val = 1
                        id = $(this).parent().find('.post_id').val()
                        url = url.replace(':uuid', id);
                    } else {
                        val = 0
                        id = $(this).parent().find('.post_id').val()
                        url = url.replace(':uuid', id);
                    }
                    $.ajax({
                        type: "GET",
                        url: url,
                        data: {
                            pick: val,
                            id: id
                        },
                        success: function(response) {}
                    });
                })
            });
            $(document).ready(function() {
                costumSelect2Paginate('...', $('.category'),
                    `{{ route('admin.json.category') }}`);
                $('.category').on('select2:select', function(e) {
                    $('.category_text').val(e.params.data.text);
                })
            })

            function handleRequest(actionType, url) {
                return function(e) {
                    e.preventDefault();
                    let id = $(this).attr('data-id');
                    var token = $("meta[name='csrf-token']").attr("content");
                    url = url.replace(':uuid', id);

                    Swal.fire({
                        title: `Yakin ?`,
                        text: `Ingin ${actionType} data ini ?`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#28A745',
                        cancelButtonColor: '#DC3545',
                        cancelButtonText: 'Tidak, Cancel!',
                        confirmButtonText: `Ya, ${actionType}!`,
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: actionType === 'Hapus' ? 'DELETE' : 'POST',
                                url: url,
                                data: {
                                    "_token": token
                                },
                                success: function(data) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: data.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        location.reload()
                                    });
                                },
                                error: function(xhr, status, error) {
                                    var errorMsg = xhr.responseJSON && xhr.responseJSON.message ?
                                        xhr.responseJSON.message :
                                        'An error occurred, please try again later.';
                                    Swal.fire({
                                        icon: 'error',
                                        title: errorMsg,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(function() {
                                        location.reload()
                                    });
                                }
                            });
                        }
                    });
                };
            }
            $('#delete').click(handleRequest('Hapus', "{{ route('admin.post.delete', ':uuid') }}"));
            $('#approve').click(handleRequest('Approve', "{{ route('admin.post.approve', ':uuid') }}"));
        </script>
    @endsection
