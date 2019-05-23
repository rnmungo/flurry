<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->bigIncrements('id');
            $table->timestamps();
            $table->softDeletes();
            $table->string('name', 40)->nullable($value = false);
            $table->string('lastname', 40)->nullable($value = false);
            $table->unsignedInteger('area_code_phone_id')->nullable();
            $table->foreign('area_code_phone_id')->references('id')->on('area_codes');
            $table->integer('phone')->nullable();
            $table->unsignedInteger('area_code_mobile_id')->nullable();
            $table->foreign('area_code_mobile_id')->references('id')->on('area_codes');
            $table->integer('mobile')->nullable();
            $table->string('email', 60)->nullable();
            $table->string('street', 100)->nullable($value = false);
            $table->integer('street_number')->nullable($value = false);
            $table->unsignedInteger('locality_id')->nullable();
            $table->foreign('locality_id')->references('id')->on('localities');
            $table->string('between_street_one', 100)->nullable();
            $table->string('between_street_two', 100)->nullable();
            $table->string('latitude', 20)->nullable();
            $table->string('longitude', 20)->nullable();
            $table->string('floor', 2)->nullable();
            $table->string('department', 2)->nullable();
            $table->string('facebook_nick', 40)->nullable();
            $table->boolean('facebook_verify')->nullable();
            $table->string('instagram_nick', 40)->nullable();
            $table->boolean('instagram_verify')->nullable();
            $table->string('twitter_nick', 40)->nullable();
            $table->boolean('twitter_verify')->nullable();
            $table->integer('temporary_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
