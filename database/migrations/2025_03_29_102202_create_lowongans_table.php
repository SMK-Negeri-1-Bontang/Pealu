<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('Lowongans', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('position');
            $table->string('location');
            $table->enum('employment_type', ['Full Time', 'Part Time', 'Remote']);
            $table->string('education');
            $table->string('experience');
            $table->string('category');
            $table->integer('salary_min')->nullable();
            $table->integer('salary_max')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongans');
    }
};
