<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('tel');
            $table->string('specialite');
            $table->string('localisation');
            $table->string('password')->nullable(); 
            $table->string('avatar')->nullable();
            $table->string('nombreCommandesTerminees');
            $table->integer('periode')->nullable();
            $table->rememberToken(); 
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('rank')->nullable();
            
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
}
