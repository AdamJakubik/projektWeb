<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('driver', function (Blueprint $table) {
            $table->id('id_driver');
            $table->string('name', 255);
            $table->date('dateOfBirth');
            $table->integer('driverChampion')->nullable();
            $table->integer('wins');
            $table->integer('podiums');
            $table->integer('dnfs');
            $table->foreignId('country_id_country')->constrained('country', 'id_country')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('driver');
    }
};