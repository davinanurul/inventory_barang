<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

class DaftarBarang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tm_barang_inventaris';

    protected $primaryKey = 'br_kode';
    public $incrementing = false;

    protected $fillable = [
        'br_kode',
        'jns_brg_kode',
        'user_id',
        'br_nama',
        'br_tgl_terima',
        'br_tgl_entry',
        'br_status',
    ];

    protected $dates = ['deleted_at'];


    /**
     * Generate kode barang baru dengan format INV+TAHUN+NO_URUT.
     */
    public static function generateKodeBarang()
    {
        $currentYear = Carbon::now()->format('Y');
        $prefix = 'INV' . $currentYear;

        // Ambil kode barang terakhir yang dimulai dengan prefix
        $lastKode = self::where('br_kode', 'like', "$prefix%")
            ->orderBy('br_kode', 'desc')
            ->value('br_kode');

        if ($lastKode) {
            // Ambil nomor urut terakhir dari kode barang
            $lastNumber = (int)substr($lastKode, strlen($prefix));
            $newNumber = $lastNumber + 1;
        } else {
            // Jika belum ada kode barang di tahun ini
            $newNumber = 1;
        }

        // Format nomor urut menjadi 4 digit
        $formattedNumber = str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        // Gabungkan prefix dengan nomor urut baru
        return $prefix . $formattedNumber;
    }

    public function getStatusKeteranganAttribute()
    {
        $statusList = [
            0 => 'Barang Dihapus dari Sistem',
            1 => 'Barang Kondisi Baik',
            2 => 'Barang Rusak, Bisa Diperbaiki',
            3 => 'Barang Rusak, Tidak Bisa Digunakan',
        ];

        return $statusList[$this->br_status] ?? 'Status Tidak Diketahui';
    }


    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jns_brg_kode', 'jns_brg_kode');
    }

    public function peminjamanBarang()
    {
        return $this->hasMany(DetailPeminjaman::class, 'br_kode', 'br_kode');
    }
}
