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
		Schema::table('comments', function (Blueprint $table) {
			$table->text('amp_url')->nullable()->after('decline_reason');
			$table->text('amp_key')->nullable()->after('amp_url');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('comments', function (Blueprint $table) {
			$table->dropColumn(['amp_url', 'amp_key']);
		});
	}
};
