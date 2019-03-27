<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupReceipts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_receipts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('grouprent_id');
            $table->integer('user_id');
            $table->float('single_price',8,2);
            $table->integer('lost');
            $table->float('total_price',8,2)->default(0);
            $table->float('single_fine',8,2);
            $table->integer('days');
            $table->float('total_fine',8,2)->default(0);
            $table->timestamps();
        });    //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_receipts');
    }
}
