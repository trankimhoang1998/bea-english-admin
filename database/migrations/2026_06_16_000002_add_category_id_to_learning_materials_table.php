<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('learning_materials', function (Blueprint $table) {
            $table->foreignId('material_category_id')
                ->nullable()
                ->after('description')
                ->constrained('material_categories')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('learning_materials', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\MaterialCategory::class);
            $table->dropColumn('material_category_id');
        });
    }
};
