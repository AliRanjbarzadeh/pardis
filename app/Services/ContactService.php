<?php

namespace App\Services;

use App\DataTransferObjects\ContactFormDto;
use App\DataTransferObjects\ContactFormResponseDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Mail\ContactFormResponsed;
use App\Models\ContactForm;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class ContactService
{
	public function __construct(
		protected DatatableService $datatableService,
	)
	{
	}

	public function datatable(DatatablesFilterDto $dto): JsonResponse
	{
		$contactForms = ContactForm::query()
			->regexpSearch($dto->term, ['subject'])
			->regexpSearch($dto->name, ['name'])
			->regexpSearch($dto->email, ['email'])
			->dateRangeSearch($dto->fromDate, $dto->toDate);

		$customActions = [
			//show & answer
			[
				'title' => __('admin/contact.words.form.show'),
				'url' => 'admin.contacts.show',
				'icon' => 'bx bx-reply text-primary',
				'isButton' => false,
			],
		];

		return $this->datatableService->datatable(
			query: $contactForms,
			name: 'contacts',
			customActions: $customActions,
			defaultActions: ['delete']
		)->toJson();
	}

	public function store(ContactFormDto $dto): ?ContactForm
	{
		return ContactForm::create($dto->toArray());
	}

	public function answer(ContactFormResponseDto $dto, ContactForm $contactForm): bool
	{
		$update = $contactForm->update($dto->toArray());

		try {
			Mail::to($contactForm->email, $contactForm->name)->send(new ContactFormResponsed($contactForm));
		} catch (Exception $e) {
		}

		return $update;
	}

}