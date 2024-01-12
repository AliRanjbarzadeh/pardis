<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		\Illuminate\Support\Facades\DB::statement("ALTER TABLE `doctors` CHANGE `work_hour` `work_hours` JSON NULL DEFAULT NULL;");
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		\Illuminate\Support\Facades\DB::statement("ALTER TABLE `doctors` CHANGE `work_hours` `work_hour` JSON NULL DEFAULT NULL;");
	}
};
