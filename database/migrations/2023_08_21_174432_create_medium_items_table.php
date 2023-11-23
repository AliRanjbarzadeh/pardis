<?php

use App\Models\Medium;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('medium_items', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->foreignIdFor(Medium::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
			$table->morphs('model');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('medium_items');
	}
};
