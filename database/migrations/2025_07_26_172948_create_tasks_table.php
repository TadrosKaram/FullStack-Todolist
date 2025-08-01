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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');             
            $table->text('description')->nullable(); 
            $table->boolean('completed')->default(false); 
            $table->timestamp('due_date')->nullable();    

            // Start type: now or custom
            $table->enum('start_type', ['now', 'custom'])->default('now');

            // Optional custom start date
            $table->timestamp('start_date')->nullable();

            $table->enum('urgent', ['low', 'medium', 'high', 'critical'])->default('low');

            $table->timestamps();                
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
