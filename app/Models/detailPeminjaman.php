<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'td_peminjaman_barang';

    protected $primaryKey = 'pbd_id';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pbd_id',
        'pb_id',
        'br_kode',
        'pdb_tanggal',
        'pdb_sts',
    ];

    protected $attributes = [
        'pdb_sts' => '1',
    ];

    /**
     * Boot model untuk mengatur event `creating` guna menghasilkan `pbd_id`.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Periksa apakah `pbd_id` sudah diisi, jika belum, buat berdasarkan format
            if (empty($model->pbd_id) && !empty($model->pb_id)) {
                // Ambil detail terakhir berdasarkan `pb_id`
                $lastDetail = self::where('pb_id', $model->pb_id)
                    ->orderBy('pbd_id', 'desc') // Urutkan berdasarkan `pbd_id` secara menurun
                    ->first();

                // Tentukan nomor urut berikutnya
                $nextNumber = $lastDetail
                    ? (int)substr($lastDetail->pbd_id, -3) + 1 // Ambil 3 digit terakhir dan tambahkan 1
                    : 1;

                // Format nomor urut menjadi 3 digit (contoh: 001, 002, dst.)
                $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

                // Gabungkan `pb_id` dengan nomor urut untuk membentuk `pbd_id`
                $model->pbd_id = $model->pb_id . $formattedNumber;
            }
        });
    }

    public function barangInventaris()
    {
        return $this->belongsTo(DaftarBarang::class, 'br_kode', 'br_kode');
    }
}
