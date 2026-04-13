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
    Schema::table('users', function (Blueprint $table) {
        $table->decimal('total_direct_business', 12, 2)->default(0)->after('team_business');
        $table->decimal('total_business_volume', 12, 2)->default(0)->after('total_direct_business');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['total_direct_business', 'total_business_volume']);
    });
}
};
