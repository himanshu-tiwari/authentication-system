<?php

namespace project\Validation;

use Violin\Violin;
use project\User\User;

class Validator extends Violin{
	protected $user;

	public function __construct(User $user){
		$this->user = $user;

		$this->addFieldMessages([
			'email' => [
			     'uniqueEmail' => 'This email is already registered!'
			],

			'username' => [
			     'uniqueUsername' => 'This username is already registered!'
			]
		]);

	}

	public function validate_uniqueEmail($value, $input, $args){
		$user = $this->user->where('email', $value);

		return !(bool) $user->count();
	}

	public function validate_uniqueUsername($value, $input, $args){
		return !(bool) $this->user->where('username', $value)->count();
	}
}

?>