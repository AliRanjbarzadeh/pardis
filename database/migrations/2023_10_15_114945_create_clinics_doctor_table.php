<?php

use App\Models\Clinic;
use App\Models\Doctor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('clinic_doctor', function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(Clinic::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignIdFor(Doctor::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('clinic_doctor');
	}
};
