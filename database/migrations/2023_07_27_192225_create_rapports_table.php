<?php


use App\Models\Marche;
use App\Models\Annonceur;
// use App\Models\Publication;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rapports', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Marche::class)->constrained();
            $table->foreignIdFor(Annonceur::class)->constrained();
            $table->string('reference', 100)->nullable()->default('text');
            $table->string('nom_prenoms', 100)->nullable()->default('text');
            $table->string('telephone', 100)->nullable()->default('text');
            $table->string('loyer', 100)->nullable()->default('text');
            $table->string('commission', 100)->nullable()->default('text');
            $table->string('pourcentage', 100)->nullable()->default('text');
            $table->date('date')->nullable()->default((new DateTime())->format('Y-m-d H:i:s'));
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
        Schema::dropIfExists('rapports');
    }
};
