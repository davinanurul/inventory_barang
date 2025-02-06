@extends('layouts.layout')
@section('title', 'Daftar Barang')

@section('content')
    <div class="container">
        <div class="page-body">
            <div class="col-md-12 col-sm-12 ">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <select id="filter-barang" class="form-control">
                            <option value="active" {{ $filter == 'active' ? 'selected' : '' }}>Barang Aktif</option>
                            <option value="deleted" {{ $filter == 'deleted' ? 'selected' : '' }}>Barang Terhapus</option>
                            <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>Semua Barang</option>
                        </select>
                    </div>
                </div>
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Tabel Daftar Barang</h2>
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
                                                    <td class="text-center" style="width: 20%">
                                                        @if ($daftarBarang->deleted_at)
                                                            {{-- Jika barang sudah dihapus, tampilkan tombol Restore --}}
                                                            <form
                                                                action="{{ route('daftar-barang.restore', $daftarBarang->br_kode) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('PATCH')
                                                                <button type="submit" class="btn btn-small btn-primary restore-button w-100">
                                                                    <span class="icon text-white">
                                                                        <i class="fa fa-undo"></i> Pulihkan
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        @else
                                                            {{-- Jika barang belum dihapus, tampilkan tombol Edit & Hapus dalam satu grup --}}
                                                            <div class="btn-group w-100" role="group">
                                                                <a href="{{ route('daftar-barang.edit', $daftarBarang->br_kode) }}"
                                                                    class="btn btn-small btn-warning">
                                                                    <i class="fa fa-edit"></i> Edit
                                                                </a>
                                                                <button type="button"
                                                                    class="btn btn-small btn-danger delete-button">
                                                                    <i class="fa fa-trash"></i> Hapus
                                                                </button>
                                                            </div>
                                                            <form
                                                                action="{{ route('daftar-barang.destroy', $daftarBarang->br_kode) }}"
                                                                method="POST" class="delete-form" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form>
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
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: false,
                searching: true, // Mengaktifkan fitur pencarian
                paging: true, // Mengaktifkan fitur pagination
                ordering: true, // Mengaktifkan fitur pengurutan
                order: [
                    [0, 'asc']
                ] // Mengurutkan berdasarkan kolom pertama (KODE) secara ascending
            });
        });
    </script>


    <!-- SweetAlert Script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('filter-barang').addEventListener('change', function() {
            let filter = this.value;
            window.location.href = "{{ route('daftar-barang.index') }}?filter=" + filter;
        });
        
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function() {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus dari daftar barang!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('td').querySelector('.delete-form').submit();
                    }
                });
            });
        });

        document.querySelectorAll('.restore-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah form submit langsung

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Barang ini akan dipulihkan kembali!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, pulihkan!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.closest('form').submit(); // Submit form jika konfirmasi diterima
                    }
                });
            });
        });
    </script>
@endsection
