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
		Schema::create('doctors', function (Blueprint $table) {
			$table->id();
			$table->string('first_name')->fulltext();
			$table->string('last_name')->fulltext();
			$table->string('medical_number')->nullable();
			$table->longText('description');
			$table->json('work_hour')->nullable();
			$table->string('reservation_link')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('doctors');
	}
};
