<?php

namespace App\DataTransferObjects;

use App\Enums\StatusEnum;
use Illuminate\Http\Request;

class CommentDto
{
	public function __construct(
		public string     $fullName,
		public string     $body,
		public StatusEnum $status = StatusEnum::Pending,
		public ?array    $userAgentInfo = null,
		public string     $email = '',
		public string     $mobile = '',
		public ?int       $userId = null,
	)
	{
	}

	public static function fromRequest(Request $request): static
	{
		return new self(
			fullName: $request->input('full_name'),
			body: $request->input('body'),
			userAgentInfo: [],
			email: $request->input('email')
		);
	}

	public function toArray(): array
	{
		return [
			'full_name' => $this->fullName,
			'body' => $this->body,
			'email' => $this->email,
			'mobile' => $this->mobile,
			'status' => $this->status,
			'user_agent_info' => $this->userAgentInfo,
			'user_id' => $this->userId,
		];
	}
}