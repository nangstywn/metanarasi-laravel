<div id="kt_content_container" class="container-xxl">
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header" style="display: flex; align-items:center; justify-content:space-between;">
                    <h1 class="text-dark">Tag</h1>
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
                                            @forelse ($tags as $key => $tag)
                                                @if ($tag_id == $tag->id)
                                                    <tr>
                                                        <td>
                                                            <div class="btn-group">
                                                                <form wire:submit.prevent="updateTag" class="d-inline">
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
                                                                    wire:model="tag" placeholder="Input Tag">
                                                            </div>
                                                            @error('tag')
                                                                <span class="error text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td>
                                                            <div class="btn-group">

                                                                <button
                                                                    wire:click.prevent="editTag({{ $tag }})"
                                                                    class="btn btn-sm btn-warning"><i
                                                                        class="fa fa-edit"></i></button>
                                                                <button wire:click="deleteTag({{ $tag->id }})"
                                                                    class="btn btn-sm btn-danger delete"
                                                                    data-id=""><i class="fa fa-trash"></i></button>
                                                            </div>
                                                        </td>
                                                        <td>{{ $tag->name ?? '-' }}</td>
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
                                            {!! $tags->links() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.tag.create');
    </div>
    <script>
        // $('#addBrandModel').appendTo("body")
        $(function() { // let all dom elements are loaded
            $('.tambah').on('hide.bs.modal', function(e) {
                $("#tagError").hide()
            });
        });
        $('.tambah').appendTo("body")
        $('#submit').submit(function(e) {
            e.preventDefault()
            // let csrf = $('meta[name="csrf-token"]').attr('content')
            let name = $('#name').val()
            let url = "{{ route('admin.tag.store') }}"
            // $("#categoryError").show()
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
                    $("#tagError").hide()
                    window.location = "{{ route('admin.tag.index') }}"
                },
                error: function(err) {
                    if (err.status == 422) {
                        var keys = Object.keys(err.responseJSON.errors);
                        keys.forEach(function(val, key) {
                            console.log(val);
                            let ErrorId = '#' + val + 'Error';
                            $(ErrorId).show();
                            $(ErrorId).text(err
                                .responseJSON.errors[val])
                        });
                    }
                }
            });
        })
    </script>
