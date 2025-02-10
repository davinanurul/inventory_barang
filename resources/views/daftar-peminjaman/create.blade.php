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
                            <input type="text" class="form-control" id="pb_nama_siswa" name="pb_nama_siswa" readonly
                                required>
                            <div class="input-group-append">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalsiswa">
                                    Cari
                                </button>
                            </div>
                        </div>
                        <input type="text" class="form-control" id="pb_no_siswa" name="pb_no_siswa" readonly required
                            hidden>
                    </div>

                    <div id="dynamic-fields">
                        <label>Data Peminjaman:</label>
                        <div class="form-group field-group">
                            <select name="data_peminjaman[0][br_kode]" id="br_kode" class="form-control">
                                @foreach ($barang as $item)
                                    <option value="{{ $item->br_kode }}">{{ $item->br_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary mb-3" onclick="addField()">Tambah Barang</button>

                    <div class="form-group">
                        <label for="pb_harus_kembali_tgl">Tanggal Harus Kembali</label>
                        <input type="date" name="pb_harus_kembali_tgl" id="pb_harus_kembali_tgl" class="form-control"
                            required>
                    </div>

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

    <script>
        let fieldCount = 1;

        function addField() {
            fieldCount++;
            let fields = `
     <div class="form-group field-group">
         <select name="data_peminjaman[${fieldCount}][br_kode]" class="form-control">
             @foreach ($barang as $item)
                 <option value="{{ $item->br_kode }}">{{ $item->br_nama }}</option>
             @endforeach
         </select>
     </div>
 `;
            document.getElementById('dynamic-fields').insertAdjacentHTML('beforeend', fields);

            // Debugging: Periksa apakah data dinamis ditambahkan dengan benar
            console.log(document.forms[0]); // Melihat form yang sedang aktif
        }

        document.querySelector('form').addEventListener('submit', function(event) {
            const selects = document.querySelectorAll('select[name^="data_peminjaman"]');
            let valid = true;

            selects.forEach(function(select) {
                if (!select.value) {
                    valid = false;
                }
            });

            if (!valid) {
                event.preventDefault(); // Cegah submit jika ada input yang kosong
                alert('Pastikan semua data barang telah dipilih!');
            }
        });
    </script>
@endsection
