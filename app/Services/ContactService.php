<?php

namespace App\Services;

use App\DataTransferObjects\ContactFormDto;
use App\DataTransferObjects\DatatablesFilterDto;
use App\Models\ContactForm;
use Illuminate\Http\JsonResponse;

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

		return $this->datatableService->datatable(
			query: $contactForms,
			name: 'contactforms',
			hasDefaultActions: false
		)->toJson();
	}

	public function store(ContactFormDto $dto): ?ContactForm
	{
		return ContactForm::create($dto->toArray());
	}

}