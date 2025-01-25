<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        schema::create('tm_user', function (Blueprint $table){
            $table->id('user_id');
            $table->string('user_nama', 50)->nullable();
            $table->string('user_pass', 60)->nullable();
            $table->string('user_hak', 2)->nullable();
            $table->boolean('user_sts')->default(1); // Menggunakan tipe boolean dan default aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
