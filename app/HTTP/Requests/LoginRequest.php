<?php

namespace App\HTTP\Requests;

use Lumin\Requests\FormRequest;

class LoginRequest extends FormRequest
{
	public function rules(): array
	{
		return ['email' => [['name' => 'required',]], 'password' => [['name' => 'required',]],];
	}
}
