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
        Schema::create('seller_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('seller_id')->constrained()->onDelete('cascade');
            $table->decimal('subtotal', 10, 2); // Apenas os itens deste vendedor
            $table->decimal('shipping_cost', 10, 2)->default(0.00); // Frete calculado para esta loja
            $table->decimal('commission_amount', 10, 2); // Taxa retida pela plataforma nesta venda
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'canceled'])->default('pending');
            $table->string('tracking_code')->nullable(); // Código de rastreio específico deste pacote
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_orders');
    }
};
