<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('tm_user')->insert([
            [
                'user_id' => '1000000000',
                'user_nama' => 'super user',
                'user_pass' => md5('superuser123'),
                'user_hak' => 'SU',
                'user_sts' => '1'
            ]
            ]);
    }
}
