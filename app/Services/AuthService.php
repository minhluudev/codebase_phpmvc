<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Lumin\Support\Facades\Log;

class AuthService
{
	public function handleLogin($data)
	{
		Log::info($data);
		$users = User::where('email', '=', $data['email'])->get();
		Log::info($users);
		if (!$users || count($users) < 1) {
			return false;
		}

		$user = $users[0];
		if (password_verify($data['password'], $user['password'])) {
			$_SESSION['user'] = $user;

			return true;
		}

		return false;
	}

	public function handleRegister($data)
	{
		try {
			$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
			$user = User::create($data);

			return true;
		} catch (Exception $e) {
			Log::error($e->getMessage());
			return false;
		}
	}
}
