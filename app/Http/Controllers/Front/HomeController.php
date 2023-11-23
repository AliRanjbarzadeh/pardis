<?php

namespace App\Http\Controllers\Front;

use App\Enums\PageTypeEnum;
use App\Enums\SliderPageEnum;
use App\Http\Controllers\Controller;
use App\Services\BlogService;
use App\Services\ClinicService;
use App\Services\CommunicationService;
use App\Services\DoctorService;
use App\Services\InsuranceService;
use App\Services\PageService;
use App\Services\ServiceService;
use App\Services\SliderService;
use App\Services\TestimonialService;

class HomeController extends Controller
{
	public function __construct(
		protected SliderService        $sliderService,
		protected PageService          $pageService,
		protected ClinicService        $clinicService,
		protected DoctorService        $doctorService,
		protected ServiceService       $serviceService,
		protected InsuranceService     $insuranceService,
		protected BlogService          $blogService,
		protected TestimonialService   $testimonialService,
		protected CommunicationService $communicationService,
	)
	{
	}

	/*==================Index====================*/
	public function index()
	{
		//page setting
		$page = $this->pageService->find(PageTypeEnum::Home, ['metas', 'faqs', 'seo']);

		if (is_null($page)) {
			abort(404);
		}

		//set seo items
		$this->setSeo($page->seo);

		//sliders
		$sliders = $this->sliderService->all(SliderPageEnum::Home);

		//Clinics
		$clinics = $this->clinicService->all(
			limit: $page->getMetaValue('clinic')['items_to_show'],
			relations: ['media', 'seo']
		);

		//Doctors
		$doctors = $this->doctorService->all(
			limit: $page->getMetaValue('doctor')['items_to_show'],
			relations: ['media', 'seo', 'specialities']
		);

		//Services
		$services = $this->serviceService->all(
			limit: $page->getMetaValue('service')['items_to_show'],
			relations: ['media', 'seo']
		);

		//Insurances
		$insurances = $this->insuranceService->all(
			limit: $page->getMetaValue('insurance')['items_to_show'],
			relations: ['media']
		);

		//Blogs
		$blogs = $this->blogService->all(
			limit: $page->getMetaValue('blog')['items_to_show'],
			relations: ['media', 'categories']
		);

		//Testimonial
		$testimonials = $this->testimonialService->all();

		//Communications
		$communications = $this->communicationService->all();

		return view('front.contents.home.index', compact('page', 'sliders', 'clinics', 'doctors', 'services', 'testimonials', 'insurances', 'blogs', 'communications'));
	}

	/*==================Create====================*/

	/*==================Edit====================*/
}
