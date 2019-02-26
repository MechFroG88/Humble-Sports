<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GroupRents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_rents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('group_name',10);
            $table->string('teacher',10);
            $table->integer('student_id');
            $table->integer('item_id');
            $table->integer('item_tag');
            $table->integer('amount');
            $table->integer('lost');
            $table->datetime('item_out');
            $table->datetime('item_in');
            $table->datetime('due_date');
            $table->tinyInteger('status');
            $table->softDeletes();
        
        });    //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_rents');
    }
}
