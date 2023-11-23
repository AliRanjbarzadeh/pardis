<?php

namespace App\DataTransferObjects;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;

class ContactFormDto
{
	public function __construct(
		public string $content,
		public string $email,
		public string $name,
		public string $subject,
	)
	{
	}

	public static function fromRequest(Request $request): static
	{
		return new self(
			content: $request->input('content'),
			email: $request->input('email'),
			name: $request->input('name'),
			subject: $request->input('subject'),
		);
	}

	public function toArray(): array
	{
		return [
			'status' => StatusEnum::Pending,
			'content' => $this->content,
			'email' => $this->email,
			'name' => $this->name,
			'subject' => $this->subject,
		];
	}
}