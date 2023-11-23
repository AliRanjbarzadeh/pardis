<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
	use AuthorizesRequests, ValidatesRequests;

	protected ?Model $model = null;

	public function setSeo(Seo $seo)
	{
		View::share('seo', $seo);
	}

	public function getModel(): Model
	{
		return $this->model;
	}

	public function setModel(Model $model): void
	{
		$this->model = $model;
	}
}
