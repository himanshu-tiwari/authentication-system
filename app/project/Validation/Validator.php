<?php

namespace project\Validation;

use Violin\Violin;

use project\User\User;
use project\Helpers\Hash;

class Validator extends Violin{
	protected $user;

	public function __construct(User $user, Hash $hash, $auth = null){
		$this->user = $user;
		$this->hash = $hash;
		$this->auth = $auth;

		$this->addFieldMessages([
			'email' => [
			     'uniqueEmail' => 'This email is already registered!'
			],

			'username' => [
			     'uniqueUsername' => 'This username is already registered!'
			]
		]);

		$this->addRuleMessages([
			'matchesCurrentPassword' => 'It does not match your current password'
		]);
	}

	public function validate_uniqueEmail($value, $input, $args){
		$user = $this->user->where('email', $value);

		return !(bool) $user->count();
	}

	public function validate_uniqueUsername($value, $input, $args){
		return !(bool) $this->user->where('username', $value)->count();
	}

	public function validate_matchesCurrentPassword($value, $input, $args){
		if($this->auth && $this->hash->passwordCheck($value, $this->auth->password)){
			return true;
		}

		return false;
	}
}

?>