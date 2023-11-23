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
		Schema::create('media', function (Blueprint $table) {
			$table->id();
			$table->string('real_name')->comment('Media real name');
			$table->string('name')->comment('Media generated name');
			$table->string('file_name')->comment('Media file name based on name column');
			$table->string('path')->comment('Media path in disk');
			$table->string('mime_type')->comment('Media type');
			$table->integer('size')->comment('Media size in byte');
			$table->string('disk');
			$table->json('sizes')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('media');
	}
};
