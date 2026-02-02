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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('referal_code')->unique();
            $table->string('referal_by');
            $table->decimal('activation_balance', 8, 2)->nullable();
            $table->decimal('withdrawable', 8, 2)->nullable();
            $table->tinyInteger('type')->comment("1 => paid, 2 => dummy id"); // You can use tinyInteger for smaller integer values
            $table->decimal('staking_balance', 8, 2)->nullable();
            $table->integer('direct_balance')->nullable(); // Corrected from 'intedecimalger'
            $table->decimal('level_balance', 8, 2)->nullable();
            $table->decimal('total_investment', 8, 2)->nullable();
            $table->decimal('royalty_balance', 8, 2)->nullable();
            $table->decimal('team_business', 8, 2)->nullable();
            $table->string('gender')->nullable();

            $table->integer('status')->default(0)->comment("0 => inactive, 1 => active");
            $table->string('password');
            $table->string('wallet_address')->nullable();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
