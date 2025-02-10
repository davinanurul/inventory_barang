@extends('layouts.layout')
@section('title', 'Daftar Peminjaman')

@section('content')
    <div class="page-body">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Peminjaman Barang</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('daftar-peminjaman.store') }}" method="POST">
                    @csrf
                    <!-- Input Peminjaman -->
                    <div class="form-group">
                        <label for="pb_nama_siswa">Nama Siswa</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="pb_nama_siswa" name="pb_nama_siswa" readonly required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalsiswa">
                                    Cari
                                </button>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="pb_no_siswa" name="pb_no_siswa" readonly required hidden>
                    </div>
                    <!-- Select Barang -->
                    <div class="form-group">
                        <label for="br_nama">Pilih Barang</label>
                        <select class="form-control" id="br_nama" name="br_nama" required>
                            <option value="">Pilih Barang</option>
                            @foreach ($daftarBarangs as $daftarBarang)
                                <option value="{{ $daftarBarang->br_kode }}" data-name="{{ $daftarBarang->br_nama }}">
                                    {{ $daftarBarang->br_nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pb_harus_kembali_tgl">Tanggal Harus Kembali</label>
                        <input type="date" name="pb_harus_kembali_tgl" id="pb_harus_kembali_tgl" class="form-control"
                            required>
                    </div>

                    {{-- <!-- Tabel untuk menampilkan produk yang dipilih -->
                    <table id="selected-products-table" class="table">
                        <thead>
                            <tr>
                                <th>Nama Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Baris produk yang dipilih akan ditambahkan di sini -->
                        </tbody>
                    </table> --}}

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('daftar-peminjaman.index') }}" class="btn btn-secondary me-1">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Peminjaman -->
    <div class="modal fade text-left" id="modalsiswa" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content modal-centered">
                <div class="modal-header border-bottom bg-transparent">
                    <h4 class="modal-title">Data Siswa</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box table-responsive">
                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
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
                                                    <button class="btn btn-primary btn-sm pilihsiswa"
                                                        data-id="{{ $siswa->siswa_kode }}"
                                                        data-nama="{{ $siswa->siswa_nama }}">
                                                        Pilih
                                                    </button>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.pilihsiswa', function() {
            var siswaKode = $(this).data('id');
            var siswaNama = $(this).data('nama');

            $('#pb_nama_siswa').val(siswaNama);
            $('#pb_no_siswa').val(siswaKode);

            // Tutup modal setelah memilih
            $('#modalsiswa').modal('hide');
        });
    </script>

    {{-- <script>
        // Mendapatkan elemen select dan tabel
        const selectBarang = document.getElementById('br_nama');
        const tableBody = document.getElementById('selected-products-table').getElementsByTagName('tbody')[0];

        // Fungsi untuk menambah produk ke tabel
        function addProductToTable(selectedOption) {
            const productCode = selectedOption.value;
            const productName = selectedOption.getAttribute('data-name');

            // Membuat baris baru untuk tabel
            const row = tableBody.insertRow();

            // Menambahkan data barang ke dalam sel tabel
            const cell1 = row.insertCell(0);
            const cell2 = row.insertCell(1);

            cell1.textContent = productName;

            // Menambahkan tombol untuk menghapus produk
            const removeButton = document.createElement('button');
            removeButton.textContent = 'Hapus';
            removeButton.classList.add('btn', 'btn-danger');
            removeButton.type = 'button'; // Pastikan tombol bukan submit

            // Debug: Pastikan tombol Hapus berfungsi
            removeButton.onclick = function() {
                console.log('Baris akan dihapus:', row.rowIndex); // Debug: cek apakah fungsi dijalankan
                tableBody.deleteRow(row.rowIndex); // Hapus baris dari tabel
            };

            cell2.appendChild(removeButton);

            // Menyimpan ID produk ke dalam tabel jika diperlukan untuk backend (misalnya menggunakan data produk)
            row.setAttribute('data-product-id', productCode);
        }

        // Menambahkan event listener pada select untuk menangani pemilihan produk
        selectBarang.addEventListener('change', function() {
            const selectedOption = selectBarang.options[selectBarang.selectedIndex];
            console.log('Barang terpilih:', selectedOption.value); // Debugging: cek barang yang terpilih

            if (selectedOption.value) {
                addProductToTable(selectedOption);
                selectBarang.value = ''; // Reset pilihan select setelah dipilih
            }
        });
    </script> --}}
@endsection
