<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->enum('role', ['ADMIN', 'DESIGNER', 'DEVELOPER'])->nullable();
            $table->enum('designation', ['ADMIN', 'Developer'])->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['Active'])->default('Active');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
