<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action');
            $table->string('entity_type');
            $table->unsignedBigInteger('entity_id');
            $table->timestamp('executed_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_logs');
    }
};
