@extends('layouts.layout')
@section('title', 'Daftar Peminjaman')

@section('content')
    <div class="container">
        <div class="page-body">
            <div class="col-md-12 col-sm-12 ">
                <a href="{{ route('daftar-peminjaman.create') }}" class="btn btn-primary mb-3">Buat Peminjaman</a>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Peminjaman</h2>
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
                                                <th class="text-center">USER ID</th>
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
                                                    <td>{{ $daftarPeminjaman->user_id }}</td>
                                                    <td>{{ $daftarPeminjaman->pb_no_siswa }}</td>
                                                    <td>{{ $daftarPeminjaman->pb_nama_siswa }}</td>
                                                    <td>{{ $daftarPeminjaman->pb_tgl }}</td>
                                                    <td>{{ $daftarPeminjaman->pb_harus_kembali_tgl }}</td>
                                                    <td>{{ $daftarPeminjaman->status_peminjaman }}</td>
                                                    <td class="text-center" style="width: 5%">
                                                        <div class="btn-group w-100">
                                                            @if ($daftarPeminjaman->detailPeminjaman && $daftarPeminjaman->detailPeminjaman->pdb_sts == 0)
                                                                <a href="{{ route('daftar-peminjaman.detail', $daftarPeminjaman->pb_id) }}"
                                                                    class="btn btn-small btn-success w-100" title="Detail">
                                                                    <span class="icon text-white">Lihat Detail</span>
                                                                </a>
                                                            @elseif ($daftarPeminjaman->detailPeminjaman && $daftarPeminjaman->detailPeminjaman->pdb_sts == 1)
                                                                <div class="btn-group w-100">
                                                                    <a href="{{ route('pengembalian.create', ['pb_id' => $daftarPeminjaman->pb_id]) }}" 
                                                                        class="btn btn-small btn-success" title="Kembali">
                                                                         <span class="icon text-white">Kembali</span>
                                                                     </a>                                                                                                                                         
                                                                    <a href="{{ route('daftar-peminjaman.edit', $daftarPeminjaman->pb_id) }}"
                                                                        class="btn btn-small btn-warning"
                                                                        title="Edit">
                                                                        <span class="icon text-white">
                                                                            <i class="fa fa-edit"></i>
                                                                        </span>
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
