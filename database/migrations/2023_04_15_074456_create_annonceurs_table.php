<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('annonceurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom_prenoms');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('sexe');
            $table->string('parrain');
            $table->string('password');
            $table->unsignedBigInteger('quartier_id')->nullable();
            $table->foreign('quartier_id')->references('id')->on('quartiers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('commune_id')->nullable();
            $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('statut_generique_id')->nullable();
            $table->foreign('statut_generique_id')->references('id')->on('statut_generiques')->onDelete('cascade')->onUpdate('cascade');
            $table->string('created_by');
            $table->softDeletes();
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
        Schema::dropIfExists('annonceurs');
    }
};
