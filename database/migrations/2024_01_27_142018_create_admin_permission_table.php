<?php

use App\Models\Permission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('admin_permission', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('admin_id');
			$table->foreignIdFor(Permission::class)->constrained()
				->cascadeOnUpdate()
				->cascadeOnDelete();
			$table->timestamps();

			$table->foreign('admin_id')
				->references('id')
				->on('users')
				->cascadeOnUpdate()
				->cascadeOnDelete();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('admin_permission');
	}
};
