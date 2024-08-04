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
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->string('requirements')->nullable();
            $table->string('integration_agency')->nullable();
            $table->foreignId('course_id')->constrained();
            $table->string('title');
            $table->integer('workload');
            $table->enum('shift', ['day', 'afternoon', 'night']);
            $table->string('description')->nullable();
            $table->decimal('wage', total: 8, places: 2);
            $table->foreignId('address_id')->constrained();
            $table->foreignId('company_id')->constrained(table: 'users');
            $table->timestamp('expires_at', precision: 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
