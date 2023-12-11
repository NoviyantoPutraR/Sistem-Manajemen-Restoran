<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembelianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_pembelians')->insert([
            'kategori' => 'daging',
            'total' => 10.000,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
