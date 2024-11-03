<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddRolesToRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('roles')->insert([
            ['nombre' => 'admin'],
            ['nombre' => 'empresa'],
            ['nombre' => 'comprador'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('roles')->whereIn('nombre', ['admin', 'empresa', 'comprador'])->delete();
    }
}