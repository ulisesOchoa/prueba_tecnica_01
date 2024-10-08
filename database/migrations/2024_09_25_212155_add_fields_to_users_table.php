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
            $table->string('last_name')->after('name');
            $table->string('identification')->unique()->after('email_verified_at');
            $table->string('address')->nullable()->after('identification');
            $table->string('phone')->after('address');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('cascade')->after('phone');
            $table->boolean('is_boss')->default(false)->after('city_id');

            $table->unsignedBigInteger('boss_id')->nullable()->after('id');
            $table->foreign('boss_id')->references('id')->on('users')->onDelete('set null');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'last_name',
                'identification',
                'address',
                'phone',
                'city_id',
                'is_boss',
                'boss_id'
            ]);
            $table->dropSoftDeletes();
        });
    }
};
