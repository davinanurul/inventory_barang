@extends('layouts.layout')
@section('title', 'Jenis Barang')

@section('content')
    <div class="page-body">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <a href="{{ route('jenis-barang.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 5l0 14" />
                    <path d="M5 12l14 0" />
                </svg>
                Penerimaan Barang
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Jenis Barang</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">KODE</th>
                                <th class="text-center">JENIS BARANG</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenisBarangs as $jenisBarang)
                                <tr>
                                    <td>{{ $jenisBarang->jns_brg_kode }}</td>
                                    <td>{{ $jenisBarang->jns_brg_nama }}</td>
                                    <td>
                                        <a href="{{ route('jenis-barang.edit', $jenisBarang->jns_brg_kode) }}"
                                            class="btn btn-warning">
                                            <span class="icon text-white">
                                                <i class="fas fa-edit"></i>
                                            </span>Edit</a>
                                        <form action="{{ route('jenis-barang.destroy', $jenisBarang->jns_brg_kode) }}"
                                            method="POST" style="display:inline;" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger delete-button">
                                                <span class="icon text-white">
                                                    <i class="fas fa-trash"></i>
                                                </span>Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
