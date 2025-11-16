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
        Schema::create('cheques', function (Blueprint $table) {
            $table->id();
            $table->string('ref_no');
            $table->string('no');
            $table->decimal('amount', 12, 2);
            $table->string('status');
            $table->string('dvno');
            $table->string('nop');
            $table->string('cheque_type');
            $table->string('fund_type');
            $table->date('date_issued');
            $table->datetime('date_returned')->nullable();
            $table->datetime('date_cancelled')->nullable();
            $table->datetime('date_release')->nullable();

            $table->foreignId('accountcode_id')->constrained('accountcodes')->onDelete('cascade');
            $table->foreignId('respocenter_id')->constrained('respocenters')->onDelete('cascade');
            $table->foreignId('payee_id')->constrained('payees')->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cheques');
    }
};
