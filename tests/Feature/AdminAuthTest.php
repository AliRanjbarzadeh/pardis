<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Cookie;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
	use RefreshDatabase;

	public function testSuccessfulLogin(): void
	{
		//seed database
		$this->seed();

		$this->post(route('admin.auth.verify'), [
			'username' => 'aliranjbarzadeh',
			'password' => '@Ali123987',
		]);

		$this->assertAuthenticated('admin');
	}

	public function testUnsuccessfulLogin(): void
	{
		//seed database
		$this->seed();

		$this->assertInvalidCredentials([
			'username' => 'aliranjbarzadeh',
			'password' => '@Ali1239822227',
		], 'admin');
	}

	public function testEmptyPasswordValidation(): void
	{
		$response = $this->post(route('admin.auth.verify'), [
			'username' => 'aliranjbarzadeh',
		]);

		$response->assertInvalid(['password']);
	}

	public function testRememberMeOrNot(): void
	{
		//seed database
		$this->seed();

		$response = $this->post(route('admin.auth.verify'), [
			'username' => 'aliranjbarzadeh',
			'password' => '@Ali123987',
			'remember' => false,
		]);

		$cookies = $response->headers->getCookies();
		$this->assertFalse($this->hasRememberMe($cookies));
		auth('admin')->logout();

		$response = $this->post(route('admin.auth.verify'), [
			'username' => 'aliranjbarzadeh',
			'password' => '@Ali123987',
			'remember' => true,
		]);

		$cookies = $response->headers->getCookies();

		$this->assertTrue($this->hasRememberMe($cookies));
	}

	protected function hasRememberMe(array $cookies): bool
	{
		foreach ($cookies as $cookie) {
			if (Str::startsWith($cookie->getName(), 'remember_admin_')) {
				return true;
			}
		}
		return false;
	}
}
