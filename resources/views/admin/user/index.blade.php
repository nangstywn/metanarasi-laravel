@extends('layouts.master')
@section('title', 'User')
@php
    use App\Constant\Level;
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
                        <h1 class="text-dark">Users List</h1>
                    </div>

                    <div class="card-body pt-0">
                        <div class="row mb-3">
                            <div class="col">
                                <div class=""
                                    style="display: flex; align-items:center; justify-content:space-between;">
                                    {{-- <a href="{{ route('admin.post.create') }}"class="btn btn-sm btn-primary"><i
                                            class="fa fa-plus-circle"></i>Tambah</a> --}}
                                    <form action="">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <div class="col pl-0" style="max-width: 200px">
                                                <input type="text" name="q" value="{{ Request::get('q') }}"
                                                    class="form-control" placeholder="Cari User">
                                            </div>

                                            <button class="btn btn-sm btn-primary ml-2" type="submit">
                                                <i class="fa fa-filter"></i>
                                            </button>
                                        </div>
                                    </form>
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
                                                    <th width="30px"></th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Level</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($users as $user)
                                                    <tr>
                                                        <td>
                                                            <div class="btn-group">
                                                                @if (auth()->user()->level == Level::ADMIN)
                                                                    <a href="#" class="btn btn-sm btn-warning"><i
                                                                            class="fa fa-edit"></i></a>
                                                                    <a href="#" class="btn btn-sm btn-danger"
                                                                        id="delete"><i class="fa fa-trash"></i></a>
                                                                @endif
                                                            </div>
                                                        </td>
                                                        <td>{{ $user->name ?? '-' }}</td>
                                                        {{-- <td>{!! Str::limit($post->content, 200) ?? '-' !!}</td> --}}
                                                        <td>{{ $user->email ?? '-' }}</td>
                                                        <td>{!! Level::toHTML($user->level) !!}</td>
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
                                                {!! $users->links() !!}
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
    @endsection
