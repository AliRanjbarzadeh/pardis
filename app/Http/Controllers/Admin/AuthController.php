<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthRequest;

class AuthController extends Controller
{
	public function __construct()
	{
	}

	public function index()
	{
		return view('admin.contents.auth.index');
	}

	public function verify(AuthRequest $request)
	{
		if (auth('admin')->attempt($request->only('username', 'password'), $request->input('remember'))) {
			return redirect()->intended(route('admin.index'), 303);
		}

		return redirect()
			->back()
			->withInput()
			->withErrors(['message' => __('admin/auth.validations.exists')]);
	}

	public function logout()
	{
		auth('admin')->logout();

		return redirect(route('admin.auth.index'));
	}
}
