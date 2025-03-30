<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Main Classes Table
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('teacher_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null'); // Set to NULL if teacher is removed
            $table->timestamps();
        });

        // Pivot table for Class-Subject relationships (Many-to-Many)
        Schema::create('class_subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')
                  ->constrained('classes')
                  ->onDelete('cascade');
            $table->foreignId('subject_id')
                  ->constrained('subjects')
                  ->onDelete('cascade');
            $table->unique(['class_id', 'subject_id']); // Prevent duplicate entries
        });

        // Pivot table for Student-Class relationships (Many-to-Many)
        Schema::create('class_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')
                  ->constrained('classes')
                  ->onDelete('cascade');
            $table->foreignId('student_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->unique(['class_id', 'student_id']); // Prevent duplicate student-class assignment
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_students');
        Schema::dropIfExists('class_subjects');
        Schema::dropIfExists('classes');
    }
};
