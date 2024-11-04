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
        Schema::create('admin_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id'); // Reference to the admin user who performed the action
            $table->string('action')->nullable()->change();
            $table->string('table_name'); // Name of the affected table
            $table->unsignedBigInteger('record_id')->nullable(); // ID of the affected record (if applicable)
            $table->text('description')->nullable(); // Optional details about the action
            $table->timestamps();

            // Set up foreign key constraint to users table, if needed
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
