<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('email')->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('full_name')->nullable(false);
            $table->string('phone_number', 20)->nullable(true);
            $table->string('address')->nullable(true);
            $table->string('img_url')->nullable();
            $table->unsignedInteger('role_id')->nullable(false);
            $table->string('country_code')->nullable();
            $table->unsignedInteger('department_id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('department_id')->references('id')->on('departments');
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
    }
}
