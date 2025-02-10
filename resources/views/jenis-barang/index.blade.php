@extends('layouts.layout')
@section('title', 'Jenis Barang')

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="mb-4 d-flex justify-content-between">
            <a href="{{ route('jenis-barang.create') }}" class="btn btn-primary">
                Tambah Jenis Barang
            </a>
            <button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i> Print/Ekspor</button>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Tabel Jenis Barang</h2>
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
                                        <th class="text-center">JENIS BARANG</th>
                                        <th class="text-center">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($jenisBarangs as $jenisBarang)
                                        <tr>
                                            <td>{{ $jenisBarang->jns_brg_kode }}</td>
                                            <td>{{ $jenisBarang->jns_brg_nama }}</td>
                                            <td class="text-center" style="width: 12%">
                                                <a href="{{ route('jenis-barang.edit', $jenisBarang->jns_brg_kode) }}"
                                                    class="btn btn-small btn-warning">
                                                    <span class="icon text-white">
                                                        <i class="fa fa-edit"></i>
                                                    </span>Edit</a>
                                                {{-- <form action="{{ route('jenis-barang.destroy', $jenisBarang->jns_brg_kode) }}"
                                                        method="POST" style="display:inline;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-small btn-danger delete-button">
                                                            <span class="icon text-white">
                                                                <i class="fa fa-trash"></i> Hapus
                                                            </span></button>
                                                    </form> --}}
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
