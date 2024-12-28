@section('title', 'Category')
<div id="kt_content_container" class="container-xxl">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header" style="display: flex; align-items:center; justify-content:space-between;">
                    <h1 class="text-dark">Kategori</h1>
                </div>

                <div class="card-body pt-0">
                    <div class="row mb-3">
                        <div class="col">
                            <div class=""
                                style="display: flex; align-items:center; justify-content:space-between;">
                                <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#tambah"><i class="fa fa-plus-circle"></i>Tambah</a>
                                {{-- <form action="">
                                    <div class="d-flex align-items-center justify-content-end">
                                        <div class="col pl-0" style="max-width: 200px">
                                            <select name="status" class="form-select" data-control="select2"
                                                data-allow-clear="true" data-placeholder="Pilih Status ...">
                                                <option value=""></option>
                                                @foreach (StatusValidasi::labels() as $key => $val)
                                                    @if (Request::has('status'))
                                                        <option value="{{ $key }}"
                                                            {{ Request::get('status') == $key ? 'selected' : '' }}>
                                                            {{ $val }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $val }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <button class="btn btn-sm btn-primary ml-2" type="submit">
                                            <i class="fa fa-filter"></i>
                                        </button>
                                    </div>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="table-outer shadow-sm p-3 mb-5 bg-white ">
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-row-bordered gs-7" id="datatable">
                                        <thead>
                                            <tr>
                                                <th width="50px"></th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($categories as $key => $category)
                                                @if ($category_id == $category->id)
                                                    <tr>
                                                        <td>
                                                            <div class="btn-group">
                                                                <form wire:submit.prevent="updateCategory"
                                                                    class="d-inline">
                                                                    <button class="btn btn-warning"
                                                                        type="submit">Update</button>
                                                                </form>
                                                                <button class="btn btn-danger"
                                                                    wire:click="cancelEdit">Cancel</button>

                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control"
                                                                    wire:model="category" placeholder="Input Category">
                                                            </div>
                                                            @error('category')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>
                                                            <div class="btn-group">

                                                                <button
                                                                    wire:click.prevent="editCategory({{ $category }})"
                                                                    class="btn btn-sm btn-warning"><i
                                                                        class="fa fa-edit"></i></button>
                                                                <a href="#" class="btn btn-sm btn-danger delete"
                                                                    id="delete" data-id="{{ $category->uuid }}"><i
                                                                        class="fa fa-trash"></i></a>
                                                            </div>
                                                        </td>
                                                        <td>{{ $category->name ?? '-' }}</td>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">Tidak Ada Data</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12">
                                            {!! $categories->links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.category.create');
    </div>
    <script>
        // $('#addBrandModel').appendTo("body")
        $(function() { // let all dom elements are loaded
            $('.tambah').on('hide.bs.modal', function(e) {
                $("#categoryError").hide()
            });
        });
        $('.tambah').appendTo("body")
        $('#submit').submit(function(e) {
            e.preventDefault()
            // let csrf = $('meta[name="csrf-token"]').attr('content')
            let name = $('#name').val()
            let url = "{{ route('admin.category.store') }}"
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: url,
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data) {
                    $("#categoryError").hide()
                    window.location = "{{ route('admin.category.index') }}"
                },
                error: function(err) {
                    if (err.status == 422) {
                        var keys = Object.keys(err.responseJSON.errors);
                        keys.forEach(function(val, key) {
                            let ErrorId = '#' + val + 'Error';
                            $(ErrorId).show();
                            $(ErrorId).text(err
                                .responseJSON.errors[val])
                        });
                    }
                }
            });
        })

        $('.delete').click(function(e) {
            // e.preventDefault();
            let id = $(this).attr('data-id');
            var token = $("meta[name='csrf-token']").attr("content");
            let url = "{{ route('admin.category.delete', ':uuid') }}";
            url = url.replace(':uuid', id);

            Swal.fire({
                title: 'Yakin ?',
                text: "Ingin menghapus data ini ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28A745',
                cancelButtonColor: '#DC3545',
                cancelButtonText: 'Tidak, Cancel!',
                confirmButtonText: 'Ya, Hapus Aja!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: url,
                        data: {
                            "_token": token
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: data.success,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                location.reload()
                            })
                        }
                    });
                }
            })
        });
    </script>
