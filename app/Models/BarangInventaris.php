<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangInventaris extends Model
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
     * Relasi dengan jenis barang.
     */
    public function jenisBarang()
    {
        return $this->belongsTo(JenisBarang::class, 'jns_brg_kode', 'jns_brg_kode');
    }

    /**
     * Relasi dengan user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    /**
     * Fungsi untuk menghasilkan kode barang (br_kode) otomatis
     * dengan format: INV<tahun><no_urut>
     */
    public static function generateKodeBarang()
    {
        $tahun = date('Y');
        $lastItem = self::where('br_kode', 'like', 'INV'.$tahun.'%')->orderBy('br_kode', 'desc')->first();
        $noUrut = 1;

        if ($lastItem) {
            $lastKode = substr($lastItem->br_kode, -5); // Ambil 5 digit terakhir dari kode
            $noUrut = intval($lastKode) + 1;
        }

        // Format kode barang baru
        return 'INV'.$tahun.sprintf('%05d', $noUrut);
    }
}
