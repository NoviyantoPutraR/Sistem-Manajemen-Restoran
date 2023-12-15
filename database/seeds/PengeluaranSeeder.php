<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_pengeluarans')->insert([
            'jenis' => 'listrik',
            'deskripsi' => 'pembayaran listrik restoran',
            'total' => 400000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
