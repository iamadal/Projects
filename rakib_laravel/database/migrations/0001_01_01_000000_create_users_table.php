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
        // Creating the 'users' table
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->unique();  // Corrected the 'phone' column type
            $table->string('country');  // Corrected the 'country' column type
            $table->string('name');  // Corrected the 'name' column type
            $table->string('gender');  // Corrected the 'gender' column type
            $table->date('dob');  // Corrected the 'dob' column type to 'date'
            $table->integer('rating')->default(0);  // Corrected 'rating' column type to 'integer'
            $table->string('status')->default('inactive');
            $table->string('verified')->default('N/A');
            $table->rememberToken();
            $table->timestamps();
        });

        // Creating the 'password_reset_tokens' table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Creating the 'sessions' table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
