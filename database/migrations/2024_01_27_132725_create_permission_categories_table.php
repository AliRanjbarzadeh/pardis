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
		Schema::create('permission_categories', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(PermissionCategory::class)->nullable()
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table->string('name');
			$table->string('type');
			$table->integer('priority')->default(0)->index();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('permission_categories');
	}
};
