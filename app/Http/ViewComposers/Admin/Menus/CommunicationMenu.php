<?php

namespace App\Http\ViewComposers\Admin\Menus;

use App\Facades\Permission;
use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CommunicationMenu implements MenuInterface
{

	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'href' => 'javascript:void(0)',
			'is_active' => $request->routeIs('admin.communications.*'),
			'icon' => 'bx bxs-map-alt',
			'name' => __('admin/communication.plural'),
			'i18n' => 'Communications',
			'is_allowed' => Permission::can([
				'communications.create',
				'communications.index',
			]),
			'children' => collect([
				collect([
					'href' => route('admin.communications.create'),
					'is_active' => $request->routeIs('admin.communications.create'),
					'name' => __('admin/global.actions.definition'),
					'i18n' => 'Communications Create',
					'is_allowed' => Permission::can([
						'communications.create',
					]),
				]),
				collect([
					'href' => route('admin.communications.index'),
					'is_active' => $request->routeIs('admin.communications.index', 'admin.communications.edit'),
					'name' => __('admin/global.fields.archive'),
					'i18n' => 'Communications Archive',
					'is_allowed' => Permission::can([
						'communications.index',
					]),
				]),
			]),
		]);
	}
}