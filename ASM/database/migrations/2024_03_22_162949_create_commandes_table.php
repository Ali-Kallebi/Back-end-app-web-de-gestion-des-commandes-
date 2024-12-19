<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->string('nomClient');
            $table->string('prenomClient');
            $table->string('telClient');
            $table->string('mailClient');
            $table->string('localisation');
            $table->date('dateLivraison');
            $table->string('produitCommande');
            $table->decimal('montant_total', 10, 2);
            $table->string('status')->default('en_attente');
            $table->unsignedBigInteger('userId')->nullable(); // Add userId column as int
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade'); // Assuming 'users' table exists
            $table->text('rejectionReason')->nullable(); // Renamed to snake_case (convention)
            $table->timestamp('rejectionDate')->nullable();
            $table->text('description')->nullable(); // Renamed to snake_case (convention)
            $table->timestamp('date_affecte')->nullable();
            $table->timestamp('dateDebut')->nullable();
            $table->timestamp('dateFin')->nullable();
            $table->timestamp('duration')->nullable();
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
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropForeign(['userId']); // Drop foreign key constraint
        });

        Schema::dropIfExists('commandes');
    }
    
}
