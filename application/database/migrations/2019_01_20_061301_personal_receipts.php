<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonalReceipts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('personalrent_id');
            $table->integer('user_id');
            $table->integer('total_fine')->default(0);
            $table->integer('days')->default(0);
            $table->integer('fine');
            $table->integer('price');
            $table->integer('lost')->default(0);
            $table->integer('total_price')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_receipts');
    }
}
