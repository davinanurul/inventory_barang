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
                    <div class="form-group">
                        <label for="pb_no_siswa">No Siswa</label>
                        <input type="number" name="pb_no_siswa" id="pb_no_siswa" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pb_nama_siswa">Nama Siswa</label>
                        <input type="text" name="pb_nama_siswa" id="pb_nama_siswa" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="pb_harus_kembali_tgl">Tanggal Harus Kembali</label>
                        <input type="date" name="pb_harus_kembali_tgl" id="pb_harus_kembali_tgl" class="form-control"
                            required>
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
