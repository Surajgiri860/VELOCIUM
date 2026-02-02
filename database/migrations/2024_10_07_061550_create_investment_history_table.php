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
        Schema::create('investment_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->integer('amount');
            $table->string('tx_hash')->nullable();
            $table->foreignId('package_id');
            $table->integer('type')->comment("1=>paid , 2=>dummy id");
            $table->string('address')->nullable();
            $table->integer('status')->default(0)->comment("1=>Pending,2=>Active");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_history');
    }
};
