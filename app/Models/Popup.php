<?php

namespace App\Models;

use App\Enums\PopupTypeEnum;
use App\Enums\StatusEnum;
use App\Interfaces\MediaInterface;
use App\Traits\HasMedia;
use App\Traits\HasSearch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

class Popup extends Model implements MediaInterface
{
	use SoftDeletes, HasMedia, HasSearch;

	protected $guarded = ['id'];
	protected $appends = ['created_at_jalali'];
	protected $casts = ['status' => StatusEnum::class, 'type' => PopupTypeEnum::class];

	/*=============Scopes==============*/

	/*=============Accessors==============*/
	public function getCreatedAtJalaliAttribute(): string
	{
		$carbon = $this->created_at->setTimezone('Asia/Tehran');
		return Jalalian::fromCarbon($carbon)->format('Y/m/d');
	}

	public function getStatusTextAttribute(): string
	{
		$className = 'btn-danger';
		$action = '<li><button type="button" class="dropdown-item" onclick="changeStatusItem(this);" data-status="active" data-url="' . route('admin.popups.changeStatus', $this) . '">' . __("admin/status.actions.activate") . '</button></li>';
		if ($this->status == StatusEnum::Active) {
			$className = 'btn-success';
			$action = '<li><button type="button" class="dropdown-item" onclick="changeStatusItem(this);" data-status="disable" data-url="' . route('admin.popups.changeStatus', $this) . '">' . __("admin/status.actions.disable") . '</button></li>';
		}

		return '<div class="btn-group">
			<button type="button" class="btn btn-sm ' . $className . ' dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">' . __("admin/status.fields." . $this->status->value) . '</button>
			<ul class="dropdown-menu" style="">' . $action . '</ul>
</div>';
	}

	public function getIsBannerAttribute(): string
	{
		return $this->type == PopupTypeEnum::Image ? 'true' : 'false';
	}

	/*=============Relations==============*/

	/*=============Additional functions==============*/

	/*=============Vendor functions==============*/
}
