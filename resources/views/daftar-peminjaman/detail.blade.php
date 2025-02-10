@extends('layouts.layout')
@section('title', 'Detail Peminjaman')

@section('content')
    <div class="page-body">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Detail Peminjaman Barang</h6>
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 20%;">PEMINJAMAN ID</th>
                                <td>{{ $daftarPeminjaman->pb_id }}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">USER ID</th>
                                <td>{{ $daftarPeminjaman->user_id }}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">NO SISWA</th>
                                <td>{{ $daftarPeminjaman->pb_no_siswa }}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">NAMA SISWA</th>
                                <td>{{ $daftarPeminjaman->pb_nama_siswa }}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">TANGGAL PEMINJAMAN</th>
                                <td>{{ $daftarPeminjaman->pb_tgl }}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">TANGGAL PENGEMBALIAN</th>
                                <td>{{ $daftarPeminjaman->pb_harus_kembali_tgl }}</td>
                            </tr>
                            <tr>
                                <th style="width: 20%;">NAMA BARANG</th>
                                <td colspan="3">
                                    @foreach ($daftarPeminjaman->detailPeminjaman as $detail)
                                        <ul>
                                            <li>{{ $detail->barangInventaris->br_nama }}</li>
                                        </ul>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-4 mb-2 d-flex justify-content-end">
                        <a href="{{ route('daftar-peminjaman.index') }}" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
