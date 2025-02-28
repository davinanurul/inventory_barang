@extends('layouts.layout')
@section('title', 'Data Siswa')

@section('content')
<div class="page-body">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold">Input Data Siswa</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('siswa.store') }}" method="POST">
                @csrf
                <div class="form-group mt-0">
                    <label for="siswa_kode">NOMOR SISWA</label>
                    <input type="number" name="siswa_kode" id="siswa_kode" class="form-control" required>
                </div>
                <div class="form-group mt-0">
                    <label for="siswa_nama">NAMA SISWA</label>
                    <input type="text" name="siswa_nama" id="siswa_nama" class="form-control" required>
                </div>
                <div class="form-group mt-0">
                    <label for="siswa_kelas">KELAS</label>
                    <input type="text" name="siswa_kelas" id="siswa_kelas" class="form-control" required>
                </div>
                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary me-1">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
