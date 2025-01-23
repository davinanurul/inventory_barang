@extends('layouts.layout')
@section('title', 'Jenis Barang')

@section('content')
<div class="page-body">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit jenis Barang</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('jenis-barang.update', $jenisBarang->jns_brg_kode) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="jns_brg_nama">Nama Jenis Barang</label>
                    <input type="text" name="jns_brg_nama" id="jns_brg_nama" value="{{ old('jns_brg_nama', $jenisBarang->jns_brg_nama) }}" class="form-control" required>
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
