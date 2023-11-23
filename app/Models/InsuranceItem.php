<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InsuranceItem extends Model
{
	protected $guarded = ['id'];

	/*=============Scopes==============*/

	/*=============Accessors==============*/

	/*=============Relations==============*/
	public function insurance(): BelongsTo
	{
		return $this->belongsTo(Insurance::class);
	}

	/*=============Additional functions==============*/
}
