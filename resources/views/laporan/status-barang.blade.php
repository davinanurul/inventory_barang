@extends('layouts.layout')
@section('title', 'Laporan Status Barang')

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
                        <h2>Laporan Status Barang</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <!-- Filter Form -->
                        <form action="#" method="GET" class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="status" class="form-control" onchange="this.form.submit()">
                                        <option value="">Pilih Status Barang</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Baik
                                        </option>
                                        <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Rusak, dapat
                                            diperbaiki</option>
                                        <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Rusak, tidak
                                            dapat digunakan</option>
                                    </select>
                                </div>
                            </div>
                        </form>
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
                                            @forelse ($laporanStatusBarang as $statusBarang)
                                                <tr>
                                                    <td>{{ $statusBarang->br_kode }}</td>
                                                    <td>{{ $statusBarang->jenisBarang->jns_brg_nama }}</td>
                                                    <td>{{ $statusBarang->br_nama }}</td>
                                                    <td>{{ $statusBarang->br_tgl_terima }}</td>
                                                    <td>{{ $statusBarang->br_tgl_entry }}</td>
                                                    <td>
                                                        @if ($statusBarang->br_status == 1)
                                                            Baik
                                                        @elseif($statusBarang->br_status == 2)
                                                            Rusak, dapat diperbaiki
                                                        @elseif($statusBarang->br_status == 3)
                                                            Rusak, tidak dapat digunakan
                                                        @else
                                                            Tidak diketahui
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Tidak ada barang dengan status
                                                        yang dipilih.</td>
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
