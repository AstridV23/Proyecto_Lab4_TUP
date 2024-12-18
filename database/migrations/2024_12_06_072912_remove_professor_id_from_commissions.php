<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('commissions', function (Blueprint $table) {
            $table->dropForeign(['professor_id']);
            $table->dropColumn('professor_id');
        });
    }

    public function down()
    {
        Schema::table('commissions', function (Blueprint $table) {
            $table->foreignId('professor_id')->constrained()->onDelete('cascade');
        });
    }
};