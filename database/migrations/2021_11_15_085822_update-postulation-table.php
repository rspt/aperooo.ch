<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostulationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apero_user', function (Blueprint $table) {
            $table->dropForeign('apero_user_user_id_foreign');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

            $table->dropForeign('apero_user_apero_id_foreign');
            $table->foreign('apero_id')
                ->references('id')->on('aperos')
                ->onDelete('cascade');
        });
    }   



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apero_user', function (Blueprint $table) {
            $table->dropForeign('apero_user_user_id_foreign');
            $table->foreign('user_id')->references('id')->on('users');

            $table->dropForeign('apero_user_apero_id_foreign');
            $table->foreign('apero_id')->references('id')->on('aperos');
        });
    }
}