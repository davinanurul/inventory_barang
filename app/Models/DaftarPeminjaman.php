<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DaftarPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'tm_peminjaman';

    protected $primaryKey = 'pb_id';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'pb_id',
        'user_id',
        'pb_tgl',
        'pb_no_siswa',
        'pb_nama_siswa',
        'pb_harus_kembali_tgl',
        'pb_stat',
    ];

    protected $attributes = [
        'pb_stat' => '1', 
    ];

    public static function generatePbId()
    {
        // Ambil tahun dan bulan saat ini
        $tahun = now()->format('Y');
        $bulan = now()->format('m');

        // Ambil ID terakhir berdasarkan format PJ+TAHUN+BULAN
        $lastTransaction = self::where('pb_id', 'like', "PJ$tahun$bulan%")
            ->orderBy('pb_id', 'desc')
            ->first();

        // Tentukan nomor urut berikutnya
        $noUrut = 1; // Default jika tidak ada transaksi sebelumnya
        if ($lastTransaction) {
            $lastId = $lastTransaction->pb_id;
            $lastNoUrut = (int)substr($lastId, -4); // Ambil 4 digit terakhir (NO_URUT)
            $noUrut = $lastNoUrut + 1;
        }

        // Formatkan ID baru
        return sprintf('PJ%s%s%04d', $tahun, $bulan, $noUrut);
    }

    public function getStatusPeminjamanAttribute()
    {
        $statusList = [
            0 => 'Peminjaman dihapus dari system',
            1 => 'Pemjaman aktif',
        ];

        return $statusList[$this->pb_stat] ?? 'Status Tidak Diketahui';
    }


    // Relasi ke tabel tm_user (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function detailPeminjaman()
    {
        return $this->hasOne(DetailPeminjaman::class, 'pb_id', 'pb_id');
    }
}
