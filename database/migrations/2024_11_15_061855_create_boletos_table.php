<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Eliminar la tabla si ya existe
        Schema::dropIfExists('boletos');

        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reserva_id');
            $table->string('codigo_boleto')->unique();
            $table->string('estado_boleto')->default('activo');
            $table->timestamps(); // Asegurarse de que las columnas created_at y updated_at se agreguen automáticamente

            $table->foreign('reserva_id')->references('id')->on('compras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boletos');
    }
}