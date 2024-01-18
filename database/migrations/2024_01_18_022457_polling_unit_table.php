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
        Schema::create('p_u_t', function (Blueprint $table) {
            $table->id('result_id');
            $table->string('polling_unit_uniqueid',50)->nullable();
            $table->char('party_abbreviation',4);
            $table->integer('party_score');
            $table->string('entered_by_user',50)->nullable();
            $table->dateTime('date_entered');
            $table->timestamps();
            $table->string('user_ip_address',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_u_t');
    }
};
