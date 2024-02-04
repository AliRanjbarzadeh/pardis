<?php

use App\Models\PermissionCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('permissions', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(PermissionCategory::class)
				->constrained()
				->cascadeOnUpdate()
				->restrictOnDelete();
			$table->string('name');
			$table->string('type');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('permissions');
	}
};
