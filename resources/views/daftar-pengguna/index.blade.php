@extends('layouts.layout')
@section('title', 'Daftar Pengguna')

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('daftar-pengguna.create') }}" class="btn btn-primary">
            Tambah Pengguna
        </a><div></div> <!-- Placeholder jika diperlukan konten di kiri -->
            <button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i> Print/Ekspor</button>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Daftar Pengguna</h2>
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
                                        <th class="text-center">HAK AKSES</th>
                                        <th class="text-center">TANGGAL DIBUAT</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftarPengguna as $daftarPengguna)
                                        <tr>
                                            <td>{{ $daftarPengguna->user_id }}</td>
                                            <td>{{ $daftarPengguna->user_nama }}</td>
                                            <td>{{ $daftarPengguna->user_hak }}</td>
                                            <td>{{ $daftarPengguna->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $daftarPengguna->user_sts ? 'Aktif' : 'Nonaktif' }}</td>
                                            <td style="width: 10%">
                                                @if ($daftarPengguna->user_sts)
                                                    <button class="btn btn-small btn-danger"
                                                        onclick="confirmDeactivation({{ $daftarPengguna->user_id }}, 'nonaktifkan')">
                                                        Nonaktifkan
                                                    </button>
                                                @else
                                                    <button class="btn btn-small btn-success"
                                                        onclick="confirmDeactivation({{ $daftarPengguna->user_id }}, 'aktifkan')">
                                                        Aktifkan
                                                    </button>
                                                @endif
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
        
        function confirmDeactivation(userId, action) {
            let title, text, confirmButtonText;

            if (action === 'nonaktifkan') {
                title = 'Konfirmasi';
                text = 'Apakah Anda yakin ingin menonaktifkan akun ini?';
                confirmButtonText = 'Ya, Nonaktifkan';
            } else if (action === 'aktifkan') {
                title = 'Konfirmasi';
                text = 'Apakah Anda yakin ingin mengaktifkan akun ini?';
                confirmButtonText = 'Ya, Aktifkan';
            }

            Swal.fire({
                title: title,
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: confirmButtonText,
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    if (action === 'nonaktifkan') {
                        window.location.href = '/nonaktifkan-akun/' + userId;
                    } else if (action === 'aktifkan') {
                        window.location.href = '/aktifkan-akun/' + userId;
                    }
                }
            });
        }
    </script>
@endsection
