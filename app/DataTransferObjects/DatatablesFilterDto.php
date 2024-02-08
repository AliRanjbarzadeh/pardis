<?php

namespace App\DataTransferObjects;

class DatatablesFilterDto
{
	public function __construct(
		public ?string $term = null,
		public ?string $name = null,
		public ?string $email = null,
		public ?string $fromDate = null,
		public ?string $toDate = null,
		public ?string $status = null,
		public ?string $type = null,
		public ?int    $parent = null,
		public bool    $hasChildren = false,
		public ?int    $categoryId = null,
		public ?array  $ids = null,
		public ?array  $customColumns = null,
		public bool    $hasChildRelated = false,
	)
	{
	}
}