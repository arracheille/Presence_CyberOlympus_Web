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
        Schema::create('attendance_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workspace_id')->constrained();
            $table->string('min_check_in');
            $table->string('max_check_in');
            $table->string('min_check_out');
            $table->string('max_check_out');
            $table->string('min_break_in');
            $table->string('max_break_in');
            $table->string('min_break_out');
            $table->string('max_break_out');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendance_infos');
    }
};
