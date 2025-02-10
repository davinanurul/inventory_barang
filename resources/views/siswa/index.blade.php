@extends('layouts.layout')
@section('title', 'Data Siswa')

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('siswa.create') }}" class="btn btn-primary">
                Tambah Data Siswa
            </a>
            <button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i> Print/Ekspor</button>
        </div>   
        <div class="x_panel">
            <div class="x_title">
                <h2>Tabel Daftar Siswa</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable-responsive" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">NOMOR SISWA</th>
                                        <th class="text-center">NAMA SISWA</th>
                                        <th class="text-center">KELAS</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($daftarSiswa as $siswa)
                                        <tr>
                                            <td>{{ $siswa->siswa_kode }}</td>
                                            <td>{{ $siswa->siswa_nama }}</td>
                                            <td>{{ $siswa->siswa_kelas }}</td>
                                            <td class="text-center" style="width: 12%">
                                                <a href="{{ route('siswa.edit', $siswa->siswa_kode) }}"
                                                    class="btn btn-small btn-warning">
                                                    <span class="icon text-white">
                                                        <i class="fa fa-edit"></i>
                                                    </span>Edit</a>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data untuk tabel ini.</td>
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
    </script>
@endsection
