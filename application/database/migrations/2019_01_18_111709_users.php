<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cn_name',10);
<<<<<<< HEAD
            $table->string('username',30);
=======
            $table->string('username',30)->unique();
>>>>>>> 10005858fff42b47e952282688577d81754e2b68
            $table->string('password',64);
            $table->tinyInteger('type');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * type 0 : administrator
     * type 1 : user
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
