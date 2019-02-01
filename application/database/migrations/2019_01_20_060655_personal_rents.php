<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PersonalRents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_rents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('item_id');
            $table->integer('item_tag');
            $table->datetime('item_out');
            $table->datetime('item_in');
            $table->datetime('duedate');
            $table->tinyInteger('status');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExits('personal_rents');
    }
}
