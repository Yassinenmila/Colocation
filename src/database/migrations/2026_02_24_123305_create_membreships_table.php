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
        Schema::create('membreships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('colocation_id')->references('id')->on('colocations')->onDelete('cascade');
            $table->enum('role', ['owner','member'])->nullable();
            $table->date('joined_at');
            $table->date('left_at')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'colocation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membreships');
    }
};
