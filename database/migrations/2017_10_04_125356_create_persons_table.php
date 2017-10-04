<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::enableForeignKeyConstraints();

        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 255);
            $table->string('first_name', 255);
            $table->string('last_name', 255)->nullable();
            $table->string('status', 255);
            $table->string('curp', 18)->nullable();
            $table->string('profile_picture', 255)->nullable();
            $table->string('info_location', 255)->nullable();
            $table->longText('info_detail')->nullable();
            $table->timestamps();

            $table->foreign('status')->references('option')->on('person_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persons');
    }
}
