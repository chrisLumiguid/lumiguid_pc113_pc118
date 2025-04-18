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
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();

            $table->foreignId('portfolio_owner_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->foreignId('employer_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->tinyInteger('rating')->nullable();
            $table->text('testimonial_content');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
