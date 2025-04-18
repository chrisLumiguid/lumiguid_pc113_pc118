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
        Schema::create('portfolio_owners', function (Blueprint $table) {
            $table->id();

            // Link to users table (one-to-one)
            $table->foreignId('user_id')
                  ->unique()
                  ->constrained('users')
                  ->onDelete('cascade');

            // Required: Catchy professional headline (e.g., "Frontend Developer | React Expert")
            $table->string('headline');

            // Optional personal bio or "About Me"
            $table->text('about')->nullable();

            // Skills stored as comma-separated string (e.g., "UX Design,React,Animation")
            $table->string('skills')->nullable();

            // Optional professional context
            $table->string('current_company')->nullable();
            $table->string('position')->nullable();

            // Summaries for work and education
            $table->text('experience_summary')->nullable();
            $table->text('education_summary')->nullable();

            // Unified social/professional links as a JSON object (e.g., {"linkedin":"...", "github":"..."})
            $table->json('social_links')->nullable();

            // External website or portfolio link
            $table->string('personal_website')->nullable();

            // Portfolio introduction or overview
            $table->text('portfolio_overview')->nullable();

            // Images and media
            $table->string('profile_banner')->nullable();
            $table->string('profile_picture')->nullable();

            // Optional resume upload path (PDF, DOCX, etc.)
            $table->string('resume')->nullable();

            // Location & basic contact
            $table->string('location')->nullable(); // e.g., "New York, USA"
            $table->string('phone')->nullable();
            $table->string('contact_email')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_owners');
    }
};
