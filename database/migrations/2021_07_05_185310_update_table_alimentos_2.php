<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTableAlimentos2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alimentos', function (Blueprint $table) {
            $table->biginteger('id_negocio')->nullable();


            $table->foreign('id_negocio')->references('id')->on('negocios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alimentos', function (Blueprint $table) {
        $table->dropColumn("id_negocio")->nullable();
        });
    }
}
