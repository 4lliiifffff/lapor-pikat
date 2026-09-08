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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_code', 30)->unique()->index();
            $table->boolean('is_anonymous')->default(true);
            $table->string('reporter_name', 150)->nullable();
            $table->string('reporter_class', 50)->nullable();
            $table->string('reporter_phone', 30)->nullable();
            $table->string('incident_type', 50);
            $table->text('chronology');
            $table->date('incident_date')->nullable();
            $table->string('incident_location', 150)->nullable();
            $table->string('parties_involved', 255)->nullable();
            $table->string('status', 30)->default('pending'); // pending, reviewing, investigating, resolved, rejected
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
