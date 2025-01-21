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
                <form action="{{ route('daftar-barang.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="br_nama">Nama Barang</label>
                        <input type="text" name="br_nama" id="br_nama" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="jns_brg_kode">Jenis Barang</label>
                        <select class="form-control jenis-barang" id="jns_brg_kode" name="jns_brg_kode" required>
                            {{-- <option value="">Pilih Jenis Barang</option> --}}
                            @foreach ($jenisBarang as $jenisBarang)
                                <option value="{{ $jenisBarang->jns_brg_kode }}" aria-placeholder="Pilih Jenis Barang">
                                    {{ $jenisBarang->jns_brg_nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="br_tgl_terima">Tanggal Terima</label>
                        <input type="date" name="br_tgl_terima" id="br_tgl_terima" class="form-control" required>
                    </div>

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('jenis-barang.index') }}" class="btn btn-outline-primary me-1">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
