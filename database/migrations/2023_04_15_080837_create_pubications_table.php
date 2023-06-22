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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->integer('piece');
            $table->integer('caution');
            $table->string('description');
            $table->unsignedBigInteger('annonceur_id');
            $table->foreign('annonceur_id')->references('id')->on('annonceurs')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('commune_id');
            $table->foreign('commune_id')->references('id')->on('communes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('budget_id');
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('quartier_id')->nullable();
            $table->foreign('quartier_id')->references('id')->on('quartiers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('pubications');
    }
};
