<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class InitTestData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('user')->insertOrIgnore([
            ['id' => 1, 'role_id' => 1, 'name' => 'Vladimir', 'last_name' => 'Krugov', 'email' => 'vkrugov11@gmail.com', 'password' => '123', 'gender_id' => '1', 'created_at' => 1584302277, 'updated_at' => 1584302277],
            ['id' => 2, 'role_id' => 1, 'name' => 'Sasha', 'last_name' => 'Bondarenko', 'email' => 'sasha.bond@gmail.com', 'password' => '123', 'gender_id' => '2', 'created_at' => 1584302277, 'updated_at' => 1584302277],
            ['id' => 3, 'role_id' => 1, 'name' => 'Ivan', 'last_name' => 'Ivanov', 'email' => 'ivan123@gmail.com', 'password' => '123', 'gender_id' => '1', 'created_at' => 1584302277, 'updated_at' => 1584302277],
        ]);
        DB::table('product')->insertOrIgnore([
            ['id' => 1, 'name' => 'Test Bouquet', 'desc' => 'Test bouquet', 'cost' => 650, 'product_type_id' => 1, 'img' => '', 'created_at' => 1584302277, 'updated_at' => 1584302277],
            ['id' => 2, 'name' => 'Test Box', 'desc' => 'Test box', 'cost' => 750, 'product_type_id' => 2, 'img' => '', 'created_at' => 1584302277, 'updated_at' => 1584302277],
            ['id' => 3, 'name' => 'Test Bouquet 2', 'desc' => 'Test bouquet', 'cost' => 600, 'product_type_id' => 1, 'img' => '', 'created_at' => 1584302277, 'updated_at' => 1584302277],
        ]);
        DB::table('product_to_cat')->insertOrIgnore([
            ['product_id' => 1, 'cat_id' => 1],
            ['product_id' => 2, 'cat_id' => 1],
            ['product_id' => 1, 'cat_id' => 1],
        ]);
        DB::table('order')->insertOrIgnore([
            ['id' => 1, 'user_id' => 1, 'note' => 'test',  'cost' => 2050, 'confirm_at' => 1584302277,  'sent_at' => 1584302277,  'created_at' => 1584302277,  'updated_at' => 1584302277],
            ['id' => 2, 'user_id' => 2, 'note' => 'test', 'cost' => 750, 'confirm_at' => null,  'sent_at' => null,  'created_at' => 1584302277,  'updated_at' => 1584302277],
            ['id' => 3, 'user_id' => 1, 'note' => 'test', 'cost' => 600, 'confirm_at' => 1584302277,  'sent_at' => null,  'created_at' => 1584302277,  'updated_at' => 1584302277],
        ]);
        DB::table('order_products')->insertOrIgnore([
            ['order_id' => 1, 'product_id' => 1, 'cost' => 650],
            ['order_id' => 1, 'product_id' => 1, 'cost' => 650],
            ['order_id' => 1, 'product_id' => 2, 'cost' => 750],
            ['order_id' => 2, 'product_id' => 1, 'cost' => 750],
            ['order_id' => 3, 'product_id' => 3, 'cost' => 600],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('user')->delete();
        DB::table('product')->delete();
        DB::table('product_to_cat')->delete();
        DB::table('order')->delete();
        DB::table('order_products')->delete();
    }
}
