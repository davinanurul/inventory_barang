@extends('layouts.layout')
@section('title', 'Jenis Barang')

@section('content')
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="col-md-12 col-sm-12 ">
            <div class="mb-4">
                <a href="{{ route('jenis-barang.create') }}" class="btn btn-primary">
                    Jenis Barang
                </a>
            </div>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Jenis Barang</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
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
                                                <td style="width: 20%">
                                                    <a href="{{ route('jenis-barang.edit', $jenisBarang->jns_brg_kode) }}"
                                                        class="btn btn-small btn-warning">
                                                        <span class="icon text-white">
                                                            <i class="fa fa-edit"></i>
                                                        </span>Edit</a>
                                                    <form action="{{ route('jenis-barang.destroy', $jenisBarang->jns_brg_kode) }}"
                                                        method="POST" style="display:inline;" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-small btn-danger delete-button">
                                                            <span class="icon text-white">
                                                                <i class="fa fa-trash"></i> Hapus
                                                            </span></button>
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
