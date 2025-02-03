<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'tm_pengembalian';
    protected $primaryKey = 'kembali_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kembali_id',
        'pb_id',
        'user_id',
        'kembali_tgl',
        'kembali_sts'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(DaftarPeminjaman::class, 'pb_id', 'pb_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public static function generateKembaliId()
    {
        $tahun = Carbon::now()->format('Y');
        $bulan = Carbon::now()->format('m');
        
        // Ambil nomor urut terakhir
        $lastRecord = Pengembalian::where('kembali_id', 'LIKE', "KB$tahun$bulan%")
            ->orderBy('kembali_id', 'desc')
            ->first();

        if ($lastRecord) {
            $lastNumber = (int) substr($lastRecord->kembali_id, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return "KB$tahun$bulan$newNumber";
    }
}
