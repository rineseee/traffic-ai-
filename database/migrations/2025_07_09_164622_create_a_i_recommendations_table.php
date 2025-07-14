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
        Schema::create('a_i_recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('traffic_node_id')->constrained()->onDelete('cascade');
            $table->text('recommendation');
            $table->timestamp('generated_at');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('a_i_recommendations');
    }
};
