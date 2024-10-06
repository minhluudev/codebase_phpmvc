<?php

namespace App\HTTP\Requests;

use Core\Request\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return ['email' => [['name' => 'required',]], 'password' => [['name' => 'required',]],];
    }
}
