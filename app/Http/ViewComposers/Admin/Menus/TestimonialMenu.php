<?php

namespace App\Http\ViewComposers\Admin\Menus;


use App\Http\ViewComposers\MenuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TestimonialMenu implements MenuInterface
{
	public static function getMenu(Request $request, string $title = ''): Collection
	{
		return collect([
			'href' => 'javascript:void(0)',
			'is_active' => $request->routeIs('admin.testimonials.*'),
			'icon' => 'bx bxs-message-square-dots',
			'name' => __('admin/testimonial.plural'),
			'i18n' => 'Testimonials',
			'children' => collect([
				collect([
					'href' => route('admin.testimonials.create'),
					'is_active' => $request->routeIs('admin.testimonials.create'),
					'name' => __('admin/global.actions.definition'),
					'i18n' => 'Testimonials Create',
				]),
				collect([
					'href' => route('admin.testimonials.index'),
					'is_active' => $request->routeIs('admin.testimonials.index', 'admin.testimonials.edit'),
					'name' => __('admin/global.fields.archive'),
					'i18n' => 'Testimonials Archive',
				]),
			]),
		]);
	}
}