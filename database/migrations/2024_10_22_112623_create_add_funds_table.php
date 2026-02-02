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
        Schema::create('add_funds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key for the user
            $table->decimal('amount', 15, 2);
            $table->integer('status')->default(1)->comment("1=>pending,2=>approved,3=>rejected ");
            $table->integer('type')->comment("1=>deposit,2=>withdrawal,"); // Type: deposit or withdrawal
            $table->string('transaction_id')->nullable(); // Transaction ID, nullable
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('add_funds');
    }
};
