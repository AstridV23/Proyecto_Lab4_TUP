<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('commission_professor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commission_id')->constrained()->onDelete('cascade');
            $table->foreignId('professor_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['commission_id', 'professor_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('commission_professor');
    }
};