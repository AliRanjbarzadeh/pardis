<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AdminPermission extends Pivot
{
	public function permission(): BelongsTo
	{
		return $this->belongsTo(Permission::class);
	}

	public function admin(): BelongsTo
	{
		return $this->belongsTo(Admin::class);
	}
}
