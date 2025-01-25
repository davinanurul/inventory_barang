@extends('layouts.layout')
@section('title', 'Daftar Pengguna')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="col-md-12 col-sm-12 ">
        <div class="mb-4">
            <a href="{{ route('daftar-pengguna.create') }}" class="btn btn-primary">
                Tambah Pengguna
            </a>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Daftar Pengguna</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">NAMA</th>
                                        <th class="text-center">PASSWORD</th>
                                        <th class="text-center">HAK AKSES</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftarPengguna as $daftarPengguna)
                                        <tr>
                                            <td>{{ $daftarPengguna->user_id }}</td>
                                            <td>{{ $daftarPengguna->user_nama }}</td>
                                            <td>{{ $daftarPengguna->user_pass }}</td>
                                            <td>{{ $daftarPengguna->user_hak }}</td>
                                            <td>{{ $daftarPengguna->user_sts ? 'Aktif' : 'Nonaktif' }}</td>
                                            <td style="width: 10%">
                                                <a href="#"
                                                    class="btn btn-small btn-danger">
                                                    <span class="icon text-white">
                                                    </span>Nonaktifkan</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
