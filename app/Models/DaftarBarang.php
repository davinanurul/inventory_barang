<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class DaftarBarang extends Model
{
    use HasFactory;

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

    /**
     * Mutator untuk default br_status
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (is_null($model->br_status)) {
                $model->br_status = 0; // Default: tersedia
            }
        });
    }

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

    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jns_brg_kode', 'jns_brg_kode');
    }
}
