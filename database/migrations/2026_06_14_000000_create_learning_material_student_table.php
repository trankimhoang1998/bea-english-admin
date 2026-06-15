<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('learning_material_student', function (Blueprint $table) {
            $table->foreignId('learning_material_id')->constrained()->cascadeOnDelete();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->primary(['learning_material_id', 'student_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_material_student');
    }
};
