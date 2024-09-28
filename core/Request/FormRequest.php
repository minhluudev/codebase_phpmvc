<?php

namespace Core\Request;


abstract class FormRequest
{

	abstract public function rules(): array;

	public function validation(): bool
	{

		return false;
	}
}