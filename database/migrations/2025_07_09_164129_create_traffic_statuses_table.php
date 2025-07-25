<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // database/migrations/xxxx_create_traffic_statuses_table.php
        Schema::create('traffic_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('traffic_node_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['light', 'moderate', 'heavy']);
            $table->timestamp('reported_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traffic_statuses');
    }
};
