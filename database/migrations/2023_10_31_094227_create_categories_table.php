<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Category::class)
				->nullable()
				->default(null)
				->comment('Category parent id')
				->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table->integer('priority')->default(0)->index();
			$table->string('name');
			$table->string('type')->comment('Which part of site use this category (E.g: insurance, clinic)');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('categories');
	}
};
