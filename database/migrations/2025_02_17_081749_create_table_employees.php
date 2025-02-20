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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id_number')->unique();
            $table->string('f_name');
            $table->string('l_name');
            $table->date('birth_date');
            $table->integer('age');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->text('address');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('guardian_name');
            $table->integer('year_level'); 
            $table->integer('dept_id'); 
            $table->integer('program_id'); 
            $table->enum('status', ['active', 'inactive']); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};