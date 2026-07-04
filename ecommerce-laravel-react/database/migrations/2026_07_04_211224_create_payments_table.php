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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('gateway'); // ex: stripe, mercadopago, pix_asaas
            $table->string('transaction_id')->unique(); // ID retornado pelo gateway
            $table->decimal('amount', 10, 2); // Valor total pago
            $table->string('payment_method'); // ex: credit_card, pix, boleto
            $table->enum('status', ['pending', 'approved', 'refunded', 'failed'])->default('pending');
            $table->json('gateway_response')->nullable(); // Guarda o JSON inteiro enviado pelo gateway para auditoria
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
