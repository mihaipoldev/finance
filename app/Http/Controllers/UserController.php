<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

	public function postSignUp(Request $request)
	{
		$this->validate($request, [
			'register_username' => 'required',
			'register_email'    => 'required|email|unique:users',
			'register_password' => 'required|min:4',
		]);

		$username = $request['register_username'];
		$email    = $request['register_email'];
		$password = bcrypt($request['register_password']);

		$user           = new User();
		$user->username = $username;
		$user->email    = $email;
		$user->password = $password;

		$user->save();

		Auth::login($user);

		return redirect()->route('index');
	}

	public function postSignIn(Request $request)
	{
		$this->validate($request, [
			'login_username' => 'required',
			'login_password' => 'required',
		]);

		$authArray = [
			'username' => $request['login_username'],
			'password' => $request['login_password'],
		];

		if (Auth::attempt($authArray)) {
			return redirect()->route('index');
		}
		return redirect()->back();
	}

	public function getLogin()
	{
		return view('login');
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect()->route('login');
	}
}