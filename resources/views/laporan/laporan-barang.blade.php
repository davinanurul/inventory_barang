@extends('layouts.layout')
@section('title', 'Laporan Daftar Barang')

@section('content')
    <div class="container">
        <div class="page-body">
            <div class="col-md-12 col-sm-12 ">
                <div class="d-flex justify-content-between">
                    <div></div> <!-- Placeholder jika diperlukan konten di kiri -->
                    <button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i> Print/Ekspor</button>
                </div>                
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Barang Yang Tersedia</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">KODE</th>
                                                <th class="text-center">JENIS</th>
                                                <th class="text-center">NAMA</th>
                                                <th class="text-center">TGL TERIMA</th>
                                                <th class="text-center">TGL MASUK</th>
                                                <th class="text-center">STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($laporanBarang as $barang)
                                                <tr>
                                                    <td>{{ $barang->br_kode }}</td>
                                                    <td>{{ $barang->jenisBarang->jns_brg_nama}}</td>
                                                    <td>{{ $barang->br_nama }}</td>
                                                    <td>{{ $barang->br_tgl_terima }}</td>
                                                    <td>{{ $barang->br_tgl_entry }}</td>
                                                    <td>{{ $barang->status_keterangan }}</td>
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
