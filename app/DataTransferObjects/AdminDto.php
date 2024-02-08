<?php

namespace App\DataTransferObjects;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;

class AdminDto
{
	public function __construct(
		public int           $roleId,
		public string        $name,
		public ?string       $username,
		public ?string       $password,
		public ?UploadedFile $profile = null,
	)
	{
	}

	public static function fromRequest(Request $request): static
	{
		return new self(
			roleId: $request->input('role_id'),
			name: $request->input('name'),
			username: $request->input('username'),
			password: $request->input('password'),
			profile: $request->file('featureImage'),
		);
	}

	public function toArray(): array
	{
		$fields = [
			'role_id' => $this->roleId,
			'name' => $this->name,
			'type' => 'admin',
		];

		if (!empty($this->username)) {
			$fields['username'] = $this->username;
		}

		if (!empty($this->password)) {
			$fields['password'] = Hash::make($this->password);
		}

		return $fields;
	}
}