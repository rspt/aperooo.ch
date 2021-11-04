<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAperosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aperos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('host_id')->constrained('users');
            $table->dateTimeTz('start');
            $table->string('address');
            $table->boolean('postulable')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aperos');
    }
}
