@extends('layouts.layout')
@section('title', 'Daftar Barang')

@section('content')
    <div class="page-body">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Daftar Barang</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('daftar-barang.update', $daftarBarang->br_kode) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="br_nama">Nama Barang</label>
                        <input type="text" name="br_nama" id="br_nama"
                            value="{{ old('br_nama', $daftarBarang->br_nama) }}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jns_brg_kode">Jenis Barang</label>
                        <select class="form-control jenis-barang" id="jns_brg_kode" name="jns_brg_kode" required>
                            <option value="">Pilih Jenis Barang</option>
                            @foreach ($jenisBarang as $jenis)
                                <option value="{{ $jenis->jns_brg_kode }}"
                                    {{ old('jns_brg_kode', $daftarBarang->jns_brg_kode) == $jenis->jns_brg_kode ? 'selected' : '' }}>
                                    {{ $jenis->jns_brg_nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('daftar-barang.index') }}" class="btn btn-outline-primary me-1">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
