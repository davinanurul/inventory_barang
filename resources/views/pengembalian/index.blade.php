@extends('layouts.layout')
@section('title', 'Daftar Pengembalian')

@section('content')
    <div class="container">
        <div class="page-body">
            <div class="d-flex justify-content-between">
                <div></div> <!-- Placeholder jika diperlukan konten di kiri -->
                <button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i> Print/Ekspor</button>
            </div>   
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Pengembalian</h2>
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
                                                <th class="text-center">PB ID</th>
                                                <th class="text-center">NAMA SISWA</th>
                                                <th class="text-center">TGL KEMBALI</th>
                                                <th class="text-center">STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pengembalians as $pengembalian)
                                                <tr>
                                                    <td>{{ $pengembalian->kembali_id }}</td>
                                                    <td>{{ $pengembalian->user->user_nama }}</td>
                                                    <td>{{ $pengembalian->pb_id }}</td>
                                                    <td>{{ $pengembalian->peminjaman->pb_nama_siswa ?? '-' }}</td>
                                                    <td>{{ $pengembalian->kembali_tgl }}</td>
                                                    <td>{{ $pengembalian->status_pengembalian }}</td>
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
