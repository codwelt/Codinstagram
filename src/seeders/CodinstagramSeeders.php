<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CodinstagramSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('codinstagramscope')->insert([
            'scope' => "basic",
        ]);
        DB::table('codinstagramscope')->insert([
            'scope' => "public_content",
        ]);
    }
}
