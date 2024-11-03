<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('fecha_nacimiento')->nullable();
            $table->string('dui')->nullable();
            $table->string('nit')->nullable();
            $table->string('telefono')->nullable();
            $table->boolean('estado')->default(true); // true para activo, false para inactivo
            $table->string('foto_perfil')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'fecha_nacimiento',
            'dui',
            'nit',
            'telefono',
            'estado',
            'foto_perfil',
        ]);
    });
}
};
