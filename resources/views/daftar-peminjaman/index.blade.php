@extends('layouts.layout')
@section('title', 'Daftar Peminjaman')

@section('content')
    <div class="container">
        <div class="page-body">
            <div class="col-md-12 col-sm-12 ">
                <div class="mb-4 d-flex justify-content-between">
                    <a href="{{ route('daftar-peminjaman.create') }}" class="btn btn-primary">
                        Buat Peminjaman
                    </a>
                    <button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i> Print/Ekspor</button>
                </div>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Peminjaman</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box table-responsive">
                                    <table id="datatable-responsive" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">NAMA USER</th>
                                                <th class="text-center">NO SISWA</th>
                                                <th class="text-center">NAMA SISWA</th>
                                                <th class="text-center">TGL PEMINJAMAN</th>
                                                <th class="text-center">TGL KEMBALI</th>
                                                <th class="text-center">STATUS</th>
                                                <th class="text-center">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($daftarPeminjamans as $daftarPeminjaman)
                                                <tr>
                                                    <td>{{ $daftarPeminjaman->pb_id }}</td>
                                                    <td>{{ $daftarPeminjaman->user->user_nama }}</td>
                                                    <td>{{ $daftarPeminjaman->pb_no_siswa }}</td>
                                                    <td>{{ $daftarPeminjaman->pb_nama_siswa }}</td>
                                                    <td>{{ $daftarPeminjaman->pb_tgl }}</td>
                                                    <td>{{ $daftarPeminjaman->pb_harus_kembali_tgl }}</td>
                                                    <td>{{ $daftarPeminjaman->status_peminjaman }}</td>
                                                    <td class="text-center">
                                                        <div class="btn-group w-100">
                                                            @php
                                                                $firstDetail = $daftarPeminjaman->detailPeminjaman->first();
                                                            @endphp
                                                    
                                                            @if ($firstDetail && $firstDetail->pdb_sts == 0)
                                                                <a href="{{ route('daftar-peminjaman.detail', $daftarPeminjaman->pb_id) }}"
                                                                    class="btn btn-small btn-success w-100" title="Detail">
                                                                    <span class="icon text-white">Detail</span>
                                                                </a>
                                                            @elseif ($firstDetail && $firstDetail->pdb_sts == 1)
                                                                <div class="btn-group w-100">
                                                                    <a href="{{ route('daftar-peminjaman.detail', $daftarPeminjaman->pb_id) }}"
                                                                        class="btn btn-small btn-success" title="Detail">
                                                                        <span class="icon text-white">Detail</span>
                                                                    </a>
                                                                    <a href="{{ route('pengembalian.create', ['pb_id' => $daftarPeminjaman->pb_id]) }}" 
                                                                        class="btn btn-small btn-warning" title="Kembali">
                                                                        <span class="icon text-white">Kembali</span>
                                                                    </a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>                                                    
                                                </tr>
                                            @endforeach
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

    <!-- SweetAlert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: {!! json_encode(session('success')) !!}
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: {!! json_encode(session('error')) !!}
                });
            @endif
        });
        
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form').submit();
                    }
                })
            });
        });
    </script>
@endsection
