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
        Schema::create('receivers', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no');
            $table->unsignedBigInteger('cheque_id');
            $table->string('name');
            $table->string('contactno');
            $table->date('date_claimed')->nullable();
            $table->longText('signature')->nullable();
            $table->timestamps();

            $table->foreign('cheque_id')->references('id')->on('cheques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receivers');
    }
};
