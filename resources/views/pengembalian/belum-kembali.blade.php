@extends('layouts.layout')
@section('title', 'Barang Belum Kembali')

@section('content')
<div class="container">
    <div class="page-body">
        <div class="col-md-12 col-sm-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Daftar Barang Belum Kembali</h2>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barangBelumKembali as $barang)
                                        <tr>
                                            <td class="text-center">{{ $barang->barangInventaris->br_kode }}</td>
                                            <td class="text-center">{{ $barang->barangInventaris->jenisBarang->jns_brg_nama }}</td>
                                            <td class="text-center">{{ $barang->barangInventaris->br_nama }}</td>
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
@endsection
