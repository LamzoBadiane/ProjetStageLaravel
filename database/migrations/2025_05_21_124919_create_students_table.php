<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('cin')->unique()->nullable(); // carte d'identité
            $table->string('phone')->nullable();
            $table->string('university')->nullable();
            $table->string('department')->nullable();
            $table->string('level')->nullable(); // Licence 3, Master 2, etc.
            $table->text('skills')->nullable(); // compétences
            $table->text('bio')->nullable(); // mini présentation
            $table->string('cv_path')->nullable(); // chemin du fichier CV

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
