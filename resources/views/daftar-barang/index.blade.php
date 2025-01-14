@extends('layouts.layout')
@section('title', 'Daftar Barang')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <a href="#" class="btn btn-primary">
                    <span class="icon text-white">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Penerimaan Barang</span>
                </a>
            </div>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Barang Inventaris</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                <tr>
                                    <td>001</td>
                                    <td>ATK</td>
                                    <td>BUKU PAKET</td>
                                    <td>12/20/2025</td>
                                    <td>12/20/2025</td>
                                    <td>Tersedia</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-warning">
                                            <span class="icon text-white">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                            <span class="text">Edit</span>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
