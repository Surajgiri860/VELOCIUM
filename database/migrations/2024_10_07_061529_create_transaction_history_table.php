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
        Schema::create('transaction_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('amount', 10, 2);
            $table->unsignedBigInteger('to')->nullable();
            $table->unsignedBigInteger('by')->nullable();
            $table->integer('status')->default(0)->comment("0=>inactive,1=>active");
            $table->integer('type')->comment("1=>withdraw,2=>Referred,3=>reward,4 =>ROI,5=>Direct ");
            $table->foreignId('reward_id')->nullable();
            $table->string('cred_date')->nullable();
            $table->string('withdrawal_address')->nullable();
            $table->string('level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_history');
    }
};
