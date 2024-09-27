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
        Schema::create('course_career_pathways', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('career_pathway_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('course_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->foreign('career_pathway_id')->references('id')->on('career_pathways')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_career_pathways');
    }
};
