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
		Schema::create('clinics', function (Blueprint $table) {
			$table->id();
			$table->integer('priority')->default(0)->index();
			$table->string('title')->fulltext();
			$table->longText('description')->fulltext();
			$table->json('work_hours')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('clinics');
	}
};
