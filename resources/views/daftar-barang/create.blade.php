@extends('layouts.layout')
@section('title', 'Penerimaan Barang')

@section('content')
    <div class="page-body">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Input Barang Inventaris</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('jenis-barang.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="jns_brg_nama">Nama Barang</label>
                        <input type="text" name="jns_brg_nama" id="jns_brg_nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jns_brg_nama">Jenis Barang</label>
                        <select class="form-control jenis-barang" id="jenis_barang" name="jenis_barang" required>
                            <option value="">Pilih Jenis Barang</option>
                            @foreach ($jenisBarang as $jenisBarang)
                                <option value="{{ $jenisBarang->jns_brg_kode }}">
                                    {{ $jenisBarang->jns_brg_nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jns_brg_nama">Tanggal Terima</label>
                        <input type="date" name="jns_brg_nama" id="jns_brg_nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jns_brg_nama">Tanggal Masuk</label>
                        <input type="date" name="jns_brg_nama" id="jns_brg_nama" class="form-control" required>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('jenis-barang.index') }}" class="btn btn-outline-primary me-1">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
