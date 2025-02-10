@extends('layouts.layout')
@section('title', 'Pengembalian Barang')

@section('content')
    <div class="page-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Pengembalian Barang</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pengembalian.store') }}" method="POST">
                    @csrf
                    <!-- Input Peminjaman -->
                    <div class="form-group">
                        <label for="peminjaman"> ID Peminjaman</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="peminjaman_id" name="pb_id"
                                value="{{ old('pb_id', $selectedPbId ?? '') }}" readonly required>
                        </div>
                    </div>
                    <!-- Daftar Nama Barang -->
                    <div class="form-group">
                        <label for="peminjaman">Nama Barang</label>
                        <div class="input-group">
                            <ul class="list-group w-100">
                                @forelse ($peminjaman->detailPeminjaman as $detail)
                                    <li class="list-group-item">
                                        {{ $detail->barangInventaris->br_nama ?? '-' }}
                                    </li>
                                @empty
                                    <li class="list-group-item text-muted">Tidak ada barang yang dipinjam</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                    <!-- Status Barang -->
                    <div class="form-group">
                        <label for="kembali_sts" class="col-form-label">Status Barang</label>
                        <div>
                            <select class="form-control" id="kembali_sts" name="kembali_sts" required>
                                <option value="" disabled selected>Pilih Status Barang</option>
                                <option value="0">Barang Kondisi Baik</option>
                                <option value="1">Barang Rusak</option>
                            </select>
                        </div>
                    </div>
                    <!-- Tombol -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('daftar-peminjaman.index') }}" class="btn btn-secondary me-1">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script untuk Memilih Data -->
    <script>
        $(document).on('click', '.pilihPeminjaman', function() {
            var pb_id = $(this).data('id'); // Ambil pb_id dari tombol

            // Masukkan pb_id ke dalam input
            $('#peminjaman_id').val(pb_id);

            // Tutup modal setelah memilih
            $('#modalPeminjaman').modal('hide');
        });
    </script>
@endsection
