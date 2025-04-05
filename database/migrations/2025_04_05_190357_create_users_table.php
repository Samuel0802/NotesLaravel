<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('email', 50)->nullable();
            $table->string('senha', 200)->nullable();
            $table->dateTime('last_login')->nullable(); //data do ultimo login
            $table->timestamps();
            $table->softDeletes(); //dado continua na tabela — apenas é ocultado das consultas padrão
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
