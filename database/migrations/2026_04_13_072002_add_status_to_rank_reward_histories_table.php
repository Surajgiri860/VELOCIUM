<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rank_reward_histories', function (Blueprint $table) {
            $table->tinyInteger('status')
                ->default(0)
                ->comment('0 = pending, 1 = released')
                ->after('amount');
        });
    }

    public function down(): void
    {
        Schema::table('rank_reward_histories', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};