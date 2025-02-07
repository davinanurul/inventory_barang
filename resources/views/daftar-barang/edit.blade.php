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
                    <div class="form-group">
                        <label for="br_tgl_terima">Tanggal Terima</label>
                        <input type="date" name="br_tgl_terima" id="br_tgl_terima"
                            value="{{ old('br_tgl_terima', $daftarBarang->br_tgl_terima) }}" class="form-control" required>
                    </div>
                    <!-- Status Barang -->
                    <div class="form-group">
                        <label for="br_status" class="col-form-label">Status Barang</label>
                        <div>
                            <select class="form-control" id="br_status" name="br_status" required>
                                <option value="" disabled
                                    {{ old('br_status', $daftarBarang->br_status) === null ? 'selected' : '' }}>Pilih Status
                                    Barang</option>
                                <option value="1"
                                    {{ old('br_status', $daftarBarang->br_status) == '1' ? 'selected' : '' }}>Barang Kondisi
                                    Baik</option>
                                <option value="2"
                                    {{ old('br_status', $daftarBarang->br_status) == '2' ? 'selected' : '' }}>Barang Rusak,
                                    Bisa Diperbaiki</option>
                                <option value="3"
                                    {{ old('br_status', $daftarBarang->br_status) == '3' ? 'selected' : '' }}>Barang Rusak,
                                    Tidak Bisa Digunakan</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('daftar-barang.index') }}" class="btn btn-secondary me-1">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
