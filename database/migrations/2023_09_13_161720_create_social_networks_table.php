<?php

use App\Models\SocialNetworkType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('social_networks', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(SocialNetworkType::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
			$table->integer('priority')->index();
			$table->string('title');
			$table->string('address');
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
		Schema::dropIfExists('social_networks');
	}
};
