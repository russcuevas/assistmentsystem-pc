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
        Schema::create('career_pathways', function (Blueprint $table) {
            $table->id();
            $table->char('riasec_id', 1);
            $table->string('career_name');
            $table->timestamps();

            $table->foreign('riasec_id')->references('id')->on('riasecs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('career_pathways');
    }
};
