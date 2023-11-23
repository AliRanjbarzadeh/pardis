<?php

namespace App\DataTransferObjects;

use App\Enums\StatusEnum;

class CommentDto
{
	public function __construct(
		public string     $fullName,
		public string     $body,
		public StatusEnum $status = StatusEnum::Pending,
		public ?string    $userAgentInfo = null,
		public string     $email = '',
		public string     $mobile = '',
		public ?int       $userId = null,
	)
	{
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