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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom_prenoms')->nullable();
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('sexe')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('commune_id')->nullable();
            $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('quartier_id')->nullable();
            $table->foreign('quartier_id')->references('id')->on('quartiers')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('statut_generique_id')->nullable();
            $table->foreign('statut_generique_id')->references('id')->on('statut_generiques')->onDelete('cascade')->onUpdate('cascade');
            $table->string('created_by')->default("Wattandoh");
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
        Schema::dropIfExists('clients');
    }
};
