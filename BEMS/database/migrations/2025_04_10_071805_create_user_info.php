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
        Schema::create('user_info', function (Blueprint $table) {
            $table->id();
            $table->string('bemsId')->unique(); // B + Grade + Serial. = B13001, B14001, B9001
            $table->string('full_name');
            $table->string('designation');
            $table->integer('grade');
            $table->datetime('joining_date');
            $table->datetime('dre'); //Date of Regularization of Employment
            $table->string('joining_letter_url');
            $table->date('prl');
            $table->string('nid');
            $table->string('phone')->unique();
            $table->string('el')->default('N/A'); // Earned leave
            $table->string('last_degree');
            $table->string('img_url');
            $table->json('extra')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('user_info');
    }
};
