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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom_prenoms');
            $table->string('email')->unique();
            $table->string('telephone');
            $table->string('adresse');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('created_by');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('statut_generique_id');
            $table->foreign('statut_generique_id')->references('id')->on('statut_generiques')->onDelete('cascade')->onUpdate('cascade');
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
