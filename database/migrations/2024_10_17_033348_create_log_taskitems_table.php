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
        Schema::create('log_taskitems', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('task_item_id')->constrained();
            $table->foreignId('label_id')->nullable()->constrained();
            $table->foreignId('schedule_id')->nullable()->constrained();
            $table->foreignId('assign_id')->nullable()->constrained();
            $table->foreignId('taskitem_member_id')->nullable()->constrained();
            $table->foreignId('cover_id')->nullable()->constrained();
            $table->foreignId('check_id')->nullable()->constrained();
            $table->foreignId('checklist_id')->nullable()->constrained();
            $table->foreignId('attachment_id')->nullable()->constrained();
            $table->foreignId('comment_id')->nullable()->constrained();
            $table->foreignId('assign_check_id')->nullable()->constrained();
            $table->foreignId('assign_checklist_id')->nullable()->constrained();
            $table->string('action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_taskitems');
    }
};
