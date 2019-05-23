<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');
            $table->timestamps();
            $table->string('name', 50)->unique();
            $table->text('description')->nullable();
            $table->string('alias', 10)->nullable();
            $table->boolean('hasTastes')->nullable();
            $table->tinyInteger('max_tastes')->nullable();
            $table->unsignedSmallInteger('weight')->nullable();
            $table->float('price', 8, 2)->nullable($value = false);
            $table->string('picture')->nullable();
            $table->boolean('closed')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
