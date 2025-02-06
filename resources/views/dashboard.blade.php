@extends('layouts.layout')
@section('title', 'Dashboard')

@section('content')
    <div class="row d-flex justify-content-center" style="padding-left: 20px; padding-right: 20px;">
        <div class="tile_count d-flex w-100 gap-3">
            <div class="tile_stats_count flex-fill text-center p-3 shadow-sm border rounded">
                <span class="count_top"><i class="fa fa-cube"></i> Jumlah Barang</span>
                <div class="count">{{ $jumlahBarang }}</div>
            </div>
            <div class="tile_stats_count flex-fill text-center p-3 shadow-sm border rounded">
                <span class="count_top"><i class="fa fa-clock-o"></i> Jumlah Peminjaman</span>
                <div class="count">{{ $jumlahPeminjaman }}</div>
            </div>
            <div class="tile_stats_count flex-fill text-center p-3 shadow-sm border rounded">
                <span class="count_top"><i class="fa fa-clock-o"></i> Barang belum Kembali</span>
                <div class="count green">{{ $jumlahPengembalian }}</div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-4">
        <div class="x_panel">
            <div class="x_title">
                <h2>Grafik Peminjaman dan Pengembalian</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div id="peminjamanChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>

    <!-- Morris.js -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Morris.Bar({
                element: 'peminjamanChart',
                data: {!! json_encode($chartData) !!},
                xkey: 'date',
                ykeys: ['peminjaman', 'pengembalian'],
                labels: ['Peminjaman', 'Pengembalian'],
                barColors: ['#26B99A', '#34495E'],
                hideHover: 'auto',
                resize: true
            });
        });
    </script>
@endsection
