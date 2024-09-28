<?php

namespace App\HTTP\Requests;

use Core\Request\FormRequest;

class RegisterRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'full_name' => [
				[
					'name' => 'required',
				],
			],
			'email' => [
				[
					'name' => 'required',
				],
				[
					'name' => 'email',
				],
			],
			'password' => [
				[
					'name' => 'required',
				],
				[
					'name' => 'password',
				],
			],
			'password_confirm' => [
				[
					'name' => 'equal',
					'field' => 'password'
				],
			],
		];
	}
}
