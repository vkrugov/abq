<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InitDefaultData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('product_type')->insert([
            ['id' => 1, 'name' => 'bouquet'],
            ['id' => 2, 'name' => 'box'],
        ]);
        DB::table('role')->insert([
            ['id' => 1, 'name' => 'admin'],
            ['id' => 2, 'name' => 'buyer'],
        ]);
        DB::table('category')->insert([
            ['id' => 1, 'name' => 'For Man'],
            ['id' => 2, 'name' => 'For Woman'],
            ['id' => 3, 'name' => 'For Kids'],
            ['id' => 4, 'name' => 'For Birthday'],
        ]);
        DB::table('settings')->insertOrIgnore([
            ['key' => 'company_name', 'value' => 'ABouquet'],
            ['key' => 'contact_city', 'value' => 'Zaporizhya'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('gender')->delete();
        DB::table('product_type')->delete();
        DB::table('role')->delete();
        DB::table('category')->delete();
        DB::table('settings')->delete();
    }
}
