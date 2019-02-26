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
            $table->integer('single_fine');
            $table->integer('fine');
            $table->tinyInteger('type');
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
