@extends('layouts.layout')
@section('title', 'Laporan Pengembalian Barang')

@section('content')
    <div class="container">
        <div class="page-body">
            <div class="col-md-12 col-sm-12 ">
                <div class="d-flex justify-content-between">
                    <div></div> <!-- Placeholder jika diperlukan konten di kiri -->
                    <button class="btn btn-primary mb-4 ms-auto">
                        <i class="fa fa-print"></i> Print Laporan
                    </button>
                </div> 
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Laporan Pengembalian Barang</h2>
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
                                                <th class="text-center">ID PEMINJAMAN</th>
                                                <th class="text-center">NAMA USER</th>
                                                <th class="text-center">TANGGAL KEMBALI</th>
                                                <th class="text-center">KONDISI BARANG</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($laporanPengembalian as $pengembalian)
                                                <tr>
                                                    <td>{{ $pengembalian->kembali_id }}</td>
                                                    <td>{{ $pengembalian->pb_id}}</td>
                                                    <td>{{ $pengembalian->user->user_nama ?? '-' }}</td>
                                                    <td>{{ $pengembalian->kembali_tgl }}</td>
                                                    <td>{{ $pengembalian->status_pengembalian }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Tidak ada data untuk tabel ini.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable(); // Ganti #example dengan ID tabel Anda
        });
    </script>
@endsection
