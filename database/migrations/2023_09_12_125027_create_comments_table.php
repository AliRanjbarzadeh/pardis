<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('comments', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(User::class)
				->nullable()
				->constrained()
				->cascadeOnUpdate()
				->nullOnDelete();
			$table->string('status')->comment('Statuses: pending, approved, rejected');
			$table->string('full_name');
			$table->string('email')->default('');
			$table->string('mobile')->default('');
			$table->text('body');
			$table->text('decline_reason')->nullable();
			$table->morphs('model');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('comments');
	}
};
