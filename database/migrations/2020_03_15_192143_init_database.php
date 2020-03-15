<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id');
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('gender_id');
            $table->integer('created_at');
            $table->integer('updated_at');
        });
        Schema::create('gender', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('desc')->default('');
        });
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desc');
            $table->integer('product_type_id');
            $table->integer('gender_id');
            $table->boolean('with_alcohol');
            $table->string('img');
            $table->integer('created_at');
            $table->integer('updated_at');
        });
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });
        Schema::create('product_to_cat', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('cat_id');
        });
        Schema::create('product_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('note')->default('');
            $table->integer('confirm_at');
            $table->integer('sent_at');
            $table->integer('created_at');
            $table->integer('updated_at');
        });
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('order_id');
        });
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('gender');
        Schema::dropIfExists('role');
        Schema::dropIfExists('product');
        Schema::dropIfExists('product_type');
        Schema::dropIfExists('order');
        Schema::dropIfExists('order_products');
    }
}
