<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'tm_user';

    protected $fillable = [
        'user_nama',
        'user_pass',
    ];

    // Tentukan kolom primary key jika berbeda dari 'id'
    protected $primaryKey = 'user_id';  // Kolom utama yang digunakan di tabel Anda

    // Tentukan kolom yang akan digunakan untuk otentikasi
    public function getAuthIdentifierName()
    {
        return 'user_id';  // Pastikan sesuai dengan kolom ID di tabel Anda
    }

    public function getAuthIdentifier()
    {
        return $this->user_id;  // Kolom ID yang digunakan untuk autentikasi
    }

    public function getAuthPassword()
    {
        return $this->user_pass;  // Kolom password yang digunakan
    }

    // Tentukan kolom 'remember_token' jika Anda ingin menggunakan fitur "remember me"
    protected $rememberTokenName = 'remember_token';
}
