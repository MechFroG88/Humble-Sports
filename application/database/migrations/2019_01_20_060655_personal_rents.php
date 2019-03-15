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
            $table->string('teacher',10);
            $table->integer('student_id');
            $table->integer('item_id');
            $table->integer('item_tag');
            $table->datetime('item_out');
            $table->datetime('item_in')->nullable();
            $table->datetime('due_date');
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->index('status');	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personal_rents');
    }
}
