@extends('layouts.layout')
@section('title', 'Daftar Barang')

@section('content')
    <div class="container">
        <div class="page-body">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Daftar Barang</h2>
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
                                                <th class="text-center">JENIS</th>
                                                <th class="text-center">NAMA</th>
                                                <th class="text-center">TGL TERIMA</th>
                                                <th class="text-center">TGL MASUK</th>
                                                <th class="text-center">STATUS</th>
                                                <th class="text-center">AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($daftarBarangs as $daftarBarang)
                                                <tr>
                                                    <td>{{ $daftarBarang->br_kode }}</td>
                                                    <td>{{ $daftarBarang->jenisBarang->jns_brg_nama }}</td>
                                                    <td>{{ $daftarBarang->br_nama }}</td>
                                                    <td>{{ $daftarBarang->br_tgl_terima }}</td>
                                                    <td>{{ $daftarBarang->br_tgl_entry }}</td>
                                                    <td>{{ $daftarBarang->status_keterangan }}</td>
                                                    <td style="width: 20%">
                                                        <a href="{{ route('daftar-barang.edit', $daftarBarang->br_kode) }}"
                                                            class="btn btn-small btn-warning">
                                                            <span class="icon text-white">
                                                                <i class="fa fa-edit"></i>
                                                            </span>Edit</a>
                                                        <form action="{{ route('daftar-barang.destroy', $daftarBarang->br_kode) }}"
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
