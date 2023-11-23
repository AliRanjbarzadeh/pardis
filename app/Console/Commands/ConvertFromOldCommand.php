<?php

namespace App\Console\Commands;

use App\DataTransferObjects\BlogDto;
use App\DataTransferObjects\CategoryDto;
use App\DataTransferObjects\ClinicDto;
use App\DataTransferObjects\DoctorDto;
use App\DataTransferObjects\FaqDto;
use App\DataTransferObjects\MetaDto;
use App\DataTransferObjects\PageDto;
use App\DataTransferObjects\SeoDto;
use App\DataTransferObjects\ServiceDto;
use App\DataTransferObjects\SliderDto;
use App\DataTransferObjects\SocialNetworkDto;
use App\DataTransferObjects\SpecialityDto;
use App\Enums\PageTypeEnum;
use App\Enums\SliderPageEnum;
use App\Enums\TypeEnum;
use App\Helpers\General;
use App\Models\Category;
use App\Models\Doctor;
use App\Models\Page;
use App\Services\BlogService;
use App\Services\CategoryService;
use App\Services\ClinicService;
use App\Services\DoctorService;
use App\Services\PageService;
use App\Services\ServiceService;
use App\Services\SliderService;
use App\Services\SpecialityService;
use Illuminate\Console\Command;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConvertFromOldCommand extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'convert:old {name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Convert from codeigniter to laravel';

	protected Connection $db;

	/**
	 * Execute the console command.
	 */
	public function handle()
	{
		$this->db = DB::connection('mysql_old');

		switch ($this->argument('name')) {
			case 'contact':
				$this->contact();
				break;

			case 'about':
				$this->about();
				break;

			case 'clinic':
				$this->clinic();
				break;

			case 'service':
				$this->service();
				break;

			case 'doctor':
				$this->doctor();
				break;

			case 'blogCategory':
				$this->blogCategory();
				break;

			case 'blog':
				$this->blog();
				break;

			case 'homeFaq':
				$this->homeFaq();
				break;

			case 'slider':
				$this->slider();
				break;
		}
	}

	private function contact(): void
	{
		$page = $this->db
			->table('pages')
			->where('id', '=', 5)
			->first();

		$page->seo = $this->db
			->table('seo_pages')
			->where('page_id', '=', $page->id)
			->first();

		$contact = $this->db
			->table('contact')
			->first();
		$contact->tel = json_decode($contact->tel);
		$contact->email = json_decode($contact->email);
		$contact->address = json_decode($contact->address);

		$socialNetworks = collect([
			new SocialNetworkDto(
				socialNetworkTypeId: 1,
				title: 'اینستاگرام',
				address: Str::afterLast($contact->instagram, '/')
			),
			new SocialNetworkDto(
				socialNetworkTypeId: 8,
				title: 'فیس بوک',
				address: Str::afterLast($contact->facebook, '/')
			),
			new SocialNetworkDto(
				socialNetworkTypeId: 4,
				title: 'توئیتر',
				address: Str::afterLast($contact->twitter, '/')
			),
			new SocialNetworkDto(
				socialNetworkTypeId: 3,
				title: 'تلگرام',
				address: Str::afterLast($contact->telegram, '/')
			),
		]);

		foreach ($contact->email as $email) {
			$socialNetworks->push(
				new SocialNetworkDto(
					socialNetworkTypeId: 7,
					title: $email->title,
					address: $email->value
				)
			);
		}

		$metas = collect([
			new MetaDto('location', [$contact->lat, $contact->lon]),
			new MetaDto('phones', implode('-', array_map(function ($item) {
				return $item->value;
			}, $contact->tel))),
		]);

		$dto = (new PageDto(
			title: $page->name,
			description: $page->seo->description,
			seo: new SeoDto(
				title: $page->seo->title,
				description: $page->seo->description,
				keywords: explode(',', $page->seo->keywords),
				link: str_replace(' ', '-', $page->name)
			)
		))->setType(PageTypeEnum::Contact);

		$newPage = Page::create($dto->toArray());
		$newPage->saveSeoInformation($dto->seo);
		$newPage->addSocialNetworks($socialNetworks);
		$newPage->addMetas($metas);
	}

	private function about(): void
	{
		$about = $this->db->table('about')->first();

		$dto = (new PageDto(
			title: $about->title,
			description: $about->short_content,
			seo: new SeoDto(
				title: $about->title,
				description: 'جموعه درمانی پردیس شیراز در سال هزار و سیصد و هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان آغاز به کار نمود .',
				keywords: explode(',', 'درباره کلینیک پردیس,درباره کلینیک سرطان پردیس,درباره کلینک سرطان پردیس شیراز'),
				link: str_replace(' ', '-', $about->title)
			)
		))->setType(PageTypeEnum::About);

		$newPage = Page::create($dto->toArray());
		$newPage->saveSeoInformation($dto->seo);
	}

	private function clinic(): void
	{
		$pageDto = (new PageDto(
			title: 'کلینیک ها',
			description: 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.',
			fullDescription: 'مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید مانند فیزیوتراپی ، آزمایشگاه ، رادیولوژی و سونوگرافی نیزافتتاح مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید مانند فیزیوتراپی ، آزمایشگاه ، رادیولوژی و سونوگرافی نیزافتتاح مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید مانند فیزیوتراپی ، آزمایشگاه ، رادیولوژی و سونوگرافی نیزافتتاح مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید مانند فیزیوتراپی ، آزمایشگاه ، رادیولوژی و سونوگرافی نیزافتتاح مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید',
			seo: new SeoDto(
				title: 'کلینیک ها',
				description: 'توضحات سئو کلینیک ها',
				link: 'کلینیک-ها'
			)
		))->setType(PageTypeEnum::Clinics)
			->setMetas([
				'items_per_page' => 9,
			]);
		app(PageService::class)->updateOrCreate($pageDto);

		$clinics = $this->db->table('clinics')->get();

		foreach ($clinics as $clinic) {
			try {

				$url = "https://pardiscancer.com/uploads/clinics/$clinic->image";
				$featureImage = General::urlToFile($url);

				$dto = (new ClinicDto(
					title: $clinic->name,
					description: $clinic->text,
					seo: new SeoDto(
						title: $clinic->name,
						description: $clinic->dsec,
						link: $clinic->link
					),
					featureImage: $featureImage
				));

				app(ClinicService::class)->store($dto);
			} catch (\Exception $e) {
				dd($e->getMessage(), $e->getLine(), $e->getFile());
			}
		}
	}

	private function service(): void
	{
		$pageDto = (new PageDto(
			title: 'خدمات',
			description: 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.',
			fullDescription: 'مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید مانند فیزیوتراپی ، آزمایشگاه ، رادیولوژی و سونوگرافی نیزافتتاح مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید مانند فیزیوتراپی ، آزمایشگاه ، رادیولوژی و سونوگرافی نیزافتتاح مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید مانند فیزیوتراپی ، آزمایشگاه ، رادیولوژی و سونوگرافی نیزافتتاح مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید مانند فیزیوتراپی ، آزمایشگاه ، رادیولوژی و سونوگرافی نیزافتتاح مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید',
			seo: new SeoDto(
				title: 'خدمات',
				description: 'توضحات سئو خدمات',
				link: 'خدمات'
			)
		))->setType(PageTypeEnum::Services)
			->setMetas([
				'items_per_page' => 9,
			]);
		app(PageService::class)->updateOrCreate($pageDto);

		$services = $this->db->table('department')->get();

		foreach ($services as $service) {
			$iconImage = General::urlToFile("https://pardiscancer.com/uploads/department/$service->icon");
			$featureImage = General::urlToFile("https://pardiscancer.com/uploads/department/$service->image");


			$dto = (new ServiceDto(
				title: $service->name,
				description: $service->dsec,
				fullDescription: $service->text,
				seo: new SeoDto(
					title: $service->name,
					description: $service->dsec,
					link: $service->link,
				),
				featureImage: $featureImage,
				iconImage: $iconImage,
			));

			app(ServiceService::class)->store($dto);
		}
	}

	private function doctor(): void
	{
		$pageDto = (new PageDto(
			title: 'متخصصین انستیتو سرطان پردیس',
			description: 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.',
			fullDescription: 'مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید مانند فیزیوتراپی ، آزمایشگاه ، رادیولوژی و سونوگرافی نیزافتتاح مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید مانند فیزیوتراپی ، آزمایشگاه ، رادیولوژی و سونوگرافی نیزافتتاح مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید مانند فیزیوتراپی ، آزمایشگاه ، رادیولوژی و سونوگرافی نیزافتتاح مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید مانند فیزیوتراپی ، آزمایشگاه ، رادیولوژی و سونوگرافی نیزافتتاح مجموعه درمانی پردیس شیراز در سال هشتاد وچهار با شعار سلامت نیاز نخست و با هدف ارتقاء سلامت شهروندان در فضایی به وسعت چهارصد متر مربع و با بخشهای اورژانس، داروخانه و دندان پزشکی در شیراز آغاز بکار نمود و پس از یکسال با توجه به استقبال شهروندان از خدمات درمانی به بخش های جدید',
			seo: new SeoDto(
				title: 'متخصصین انستیتو سرطان پردیس',
				description: 'توضحات سئو پزشکان',
				link: 'متخصصین-انستیتو-سرطان-پردیس'
			)
		))->setType(PageTypeEnum::Doctors)
			->setMetas([
				'items_per_page' => 12,
			]);
		app(PageService::class)->updateOrCreate($pageDto);

		$doctors = $this->db->table('team')->get();

		foreach ($doctors as $doctor) {
			$specialityDto = new SpecialityDto(
				name: $doctor->title,
				seo: new SeoDto(
					title: $doctor->title,
					description: $doctor->title,
					link: str_replace(' ', '-', $doctor->title)
				)
			);

			$speciality = app(SpecialityService::class)->store($specialityDto);

			$fullName = Str::after($doctor->name, 'دکتر ');

			$firstName = Str::before($fullName, ' ');
			$lastName = Str::after($fullName, ' ');


			$featureImage = General::urlToFile("https://pardiscancer.com/uploads/team/$doctor->image");

			$dto = (new DoctorDto(
				specialityId: $speciality->id,
				firstName: 'دکتر ' . $firstName,
				lastName: $lastName,
				medicalNumber: 0,
				description: '',
				fullDescription: $doctor->description,
				reservationLink: $doctor->online_reservation_link ?? '',
				seo: new SeoDto(
					title: $doctor->name,
					description: $doctor->title,
					link: str_replace(' ', '-', $doctor->name)
				),
				featureImage: $featureImage
			));

			Doctor::insert(array_merge(['id' => $doctor->id], $dto->forCreate()));

			$newDoctor = Doctor::find($doctor->id);
			app(DoctorService::class)->update($newDoctor, $dto);
		}
	}

	private function blogCategory(): void
	{
		$categories = $this->db->table('category')
			->where('is_deleted', '=', 0)
			->get();

		foreach ($categories as $category) {
			$dto = new CategoryDto(
				name: $category->name,
				type: TypeEnum::Blog->value,
				seo: new SeoDto(
					title: $category->meta_title ?? $category->name,
					description: $category->meta_description ?? $category->name,
					keywords: explode(',', $category->meta_keywords ?? ''),
					link: $category->link
				),
			);

			Category::insert(array_merge(['id' => $category->id, 'created_at' => now(), 'updated_at' => now()], $dto->toArray()));

			$newCategory = Category::find($category->id);

			app(CategoryService::class)->update($newCategory, $dto);
		}
	}

	private function blog(): void
	{
		$pageDto = (new PageDto(
			title: 'مطالب و اخبار',
			description: 'ما در مجله ی پردیس اخرین و به روز ترین روش های درمان و پیشگیری از سرطان را بیان میکنیم . شما را با انواع سرطان و تشخیص به موقع آشنا میسازیم .',
			fullDescription: 'ما در مجله ی پردیس اخرین و به روز ترین روش های درمان و پیشگیری از سرطان را بیان میکنیم . شما را با انواع سرطان و تشخیص به موقع آشنا میسازیم .',
			seo: new SeoDto(
				title: 'آخرین اخبار و مطالب در زمینه سرطان و پشگیری از ان | کلینیک کانسر پردیس',
				description: 'ما در مجله ی پردیس اخرین و به روز ترین روش های درمان و پیشگیری از سرطان را بیان میکنیم . شما را با انواع سرطان و تشخیص به موقع آشنا میسازیم .',
				link: 'مطالب -و-اخبار'
			)
		))->setType(PageTypeEnum::Blogs)
			->setMetas([
				'items_per_page' => 12,
			]);
		app(PageService::class)->updateOrCreate($pageDto);

		$blogs = $this->db->table('blog')
			->where('is_deleted', '=', 0)
			->get();

		foreach ($blogs as $blog) {
			$categoryId = $this->db->table('blog_category')
				->where('blog_id', '=', $blog->id)
				->get()
				->last()->category_id;

			$url = "https://pardiscancer.com/uploads/blog/$blog->image";
			$featureImage = General::urlToFile($url);

			$dto = (new BlogDto(
				categoryId: $categoryId,
				title: $blog->name,
				description: $blog->content,
				seo: new SeoDto(
					title: $blog->meta_title ?? $blog->name,
					description: $blog->meta_description ?? $blog->short_content,
					keywords: explode(',', $blog->meta_keywords ?? ''),
					link: $blog->link
				),
				featureImage: $featureImage
			))->setTimeStamps($blog->date_created, $blog->date_published);

			app(BlogService::class)->store($dto);
		}
	}

	private function homeFaq()
	{
		$faqs = $this->db->table('faq')->get();

		$page = Page::whereType(PageTypeEnum::Home)->first();

		$page->addFaqs($faqs->map(function ($faq) {
			return new FaqDto(
				id: 0,
				question: $faq->question,
				answer: strip_tags($faq->answer)
			);
		}));
	}

	private $index = 1;

	private function slider(): void
	{
		$sliders = $this->db->table('slider')
			->where('title', '!=', '')
			->get();

		$sliders->map(function ($slider) {
			$featureImage = General::urlToFile("https://pardiscancer.com/uploads/slider/$slider->image");
			app(SliderService::class)->store(new SliderDto(
				page: SliderPageEnum::Home,
				featureImage: $featureImage,
				priority: $this->index,
				title: $slider->title,
				description: $slider->subtitle ?? '',
				link: $slider->link,
			));
			$this->index += 1;
		});
	}
}
