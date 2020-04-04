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
        //init gender
        Schema::create('gender', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });
        //init role
        Schema::create('role', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('desc')->default('');
        });
        //init user
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('role_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('gender_id')->unsigned();
            $table->integer('created_at');
            $table->integer('updated_at');

            $table->foreign('role_id')->references('id')->on('role');
            $table->foreign('gender_id')->references('id')->on('gender');
        });

        //init product and categories
        Schema::create('product_type', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('desc');
            $table->integer('cost');
            $table->bigInteger('product_type_id')->unsigned();
            $table->string('img')->nullable();
            $table->integer('created_at');
            $table->integer('updated_at');

            $table->foreign('product_type_id')->references('id')->on('product_type');

        });
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });
        Schema::create('product_to_cat', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('cat_id')->unsigned();

            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('cat_id')->references('id')->on('category');
        });
        //init cart
        Schema::create('cart', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('product_id')->references('id')->on('product');
        });
        //init order
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('note')->nullable();
            $table->integer('confirm_at');
            $table->integer('sent_at');
            $table->integer('created_at');
            $table->integer('updated_at');

            $table->foreign('user_id')->references('id')->on('user');
        });
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->integer('cost');

            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('order_id')->references('id')->on('order');
        });;
        //init settings
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->unique();
            $table->string('key');
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
        Schema::dropIfExists('cart');
        Schema::dropIfExists('role');
        Schema::dropIfExists('product');
        Schema::dropIfExists('category');
        Schema::dropIfExists('product_type');
        Schema::dropIfExists('product_to_cat');
        Schema::dropIfExists('order');
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('settings');
    }
}
