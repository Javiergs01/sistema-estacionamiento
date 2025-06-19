<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_vehiculos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade'); // ¡Añade esta línea!

            $table->unsignedBigInteger('vehiculo_id');
            $table->foreign('vehiculo_id')
                ->references('id')
                ->on('vehiculos')
                ->onDelete('cascade'); // ¡También podrías añadirlo aquí si quieres que los vehiculos_clientes se borren si borras un vehiculo!

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente_vehiculos');
    }
}
