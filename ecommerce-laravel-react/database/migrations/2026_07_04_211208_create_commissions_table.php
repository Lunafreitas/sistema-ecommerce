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
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->nullable()->constrained()->onDelete('cascade'); // Nulo se for taxa global
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade'); // Taxa por categoria
            $table->decimal('percentage', 5, 2)->default(0.00); // ex: 10.50%
            $table->decimal('fixed_fee', 10, 2)->default(0.00); // ex: R$ 2,00 por venda
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
