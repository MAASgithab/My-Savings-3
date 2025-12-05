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
        Schema::create('targets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('savings_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Nama target
            $table->string('gambar')->nullable(); // Foto target
            $table->bigInteger('amount'); // Nominal target
            $table->bigInteger('collected')->default(0); // Uang yang terkumpul
            $table->enum('status', ['belum tercapai', 'tercapai'])->default('belum tercapai');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('targets');
    }
};
