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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('account_name');
            $table->foreign(['username', 'account_name'])
                ->references(['username', 'account_name'])
                ->on('accounts');

            // Foreign keys for receiving user and account
            $table->string('receiving_username');
            $table->string('receiving_account_name');
            $table->foreign(['receiving_username', 'receiving_account_name'])
                ->references(['username', 'account_name'])
                ->on('accounts');

            $table->decimal('transaction_amount', 10, 2);
            $table->string('currency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
