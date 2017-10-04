<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_statuses', function (Blueprint $table) {
            $table->string('option', 255)->primary();
            $table->unsignedInteger('order');
            $table->string('description', 255);
        });

        DB::table('person_statuses')->insert([
            ['option' => 'DESAPARECIDO', 'order' => 0, 'description' => 'Desaparecido'],
            ['option' => 'ENCONTRADO', 'order' => 3, 'description' => 'Encontrado'],
            ['option' => 'HOSPITALIZADO', 'order' => 2, 'description' => 'Hospitalizado'],
            ['option' => 'RESCATADO', 'order' => 1, 'description' => 'Rescatado']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_statuses');
    }
}
