@extends('layouts.layout')
@section('title', 'Jenis Barang')

@section('content')
<div class="page-body">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Input Jenis Barang</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis-barang.store') }}" method="POST">
                @csrf
                <div class="form-group mt-0">
                    <label for="jns_brg_nama">Nama Jenis Barang</label>
                    <input type="text" name="jns_brg_nama" id="jns_brg_nama" class="form-control" required>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('jenis-barang.index') }}" class="btn btn-secondary me-1">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
