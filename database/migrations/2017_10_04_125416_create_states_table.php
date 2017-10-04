<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->string('iso2', 6);
            $table->string('iso', 2);
            $table->string('region', 60);
            $table->string('alt_name1', 255)->nullable();
            $table->string('alt_name2', 255)->nullable();
        });

        DB::table('states')->insert([
            ['iso2' => 'MX-AGU', 'iso' => 'MX', 'region' => 'Aguascalientes'],
            ['iso2' => 'MX-BCN', 'iso' => 'MX', 'region' => 'Baja California'],
            ['iso2' => 'MX-BCS', 'iso' => 'MX', 'region' => 'Baja California Sur'],
            ['iso2' => 'MX-CAM', 'iso' => 'MX', 'region' => 'Campeche'],
            ['iso2' => 'MX-CHH', 'iso' => 'MX', 'region' => 'Chihuahua'],
            ['iso2' => 'MX-CHP', 'iso' => 'MX', 'region' => 'Chiapas'],
            ['iso2' => 'MX-COA', 'iso' => 'MX', 'region' => 'Coahuila de Zaragoza'],
            ['iso2' => 'MX-COL', 'iso' => 'MX', 'region' => 'Colima'],
            ['iso2' => 'MX-DIF', 'iso' => 'MX', 'region' => 'Distrito Federal'],
            ['iso2' => 'MX-DUR', 'iso' => 'MX', 'region' => 'Durango'],
            ['iso2' => 'MX-GRO', 'iso' => 'MX', 'region' => 'Guerrero'],
            ['iso2' => 'MX-GUA', 'iso' => 'MX', 'region' => 'Guanajuato'],
            ['iso2' => 'MX-HID', 'iso' => 'MX', 'region' => 'Hidalgo'],
            ['iso2' => 'MX-JAL', 'iso' => 'MX', 'region' => 'Jalisco'],
            ['iso2' => 'MX-MEX', 'iso' => 'MX', 'region' => 'México'],
            ['iso2' => 'MX-MIC', 'iso' => 'MX', 'region' => 'Michoacán de Ocampo'],
            ['iso2' => 'MX-MOR', 'iso' => 'MX', 'region' => 'Morelos'],
            ['iso2' => 'MX-NAY', 'iso' => 'MX', 'region' => 'Nayarit'],
            ['iso2' => 'MX-NLE', 'iso' => 'MX', 'region' => 'Nuevo León'],
            ['iso2' => 'MX-OAX', 'iso' => 'MX', 'region' => 'Oaxaca'],
            ['iso2' => 'MX-PUE', 'iso' => 'MX', 'region' => 'Puebla'],
            ['iso2' => 'MX-QUE', 'iso' => 'MX', 'region' => 'Querétaro Arteaga'],
            ['iso2' => 'MX-ROO', 'iso' => 'MX', 'region' => 'Quintana Roo'],
            ['iso2' => 'MX-SIN', 'iso' => 'MX', 'region' => 'Sinaloa'],
            ['iso2' => 'MX-SLP', 'iso' => 'MX', 'region' => 'San Luís Potosí'],
            ['iso2' => 'MX-SON', 'iso' => 'MX', 'region' => 'Sonora'],
            ['iso2' => 'MX-TAB', 'iso' => 'MX', 'region' => 'Tabasco'],
            ['iso2' => 'MX-TAM', 'iso' => 'MX', 'region' => 'Tamaulipas'],
            ['iso2' => 'MX-TLA', 'iso' => 'MX', 'region' => 'Tlaxcala'],
            ['iso2' => 'MX-VER', 'iso' => 'MX', 'region' => 'Veracruz Llave'],
            ['iso2' => 'MX-YUC', 'iso' => 'MX', 'region' => 'Yucatán'],
            ['iso2' => 'MX-ZAC', 'iso' => 'MX', 'region' => 'Zacatecas']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
