<?php

namespace project\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserPermission extends Eloquent{
	protected $table = 'users_permissions';

	protected $fillable = [
		'is_admin'
	];

	public static $defaults = [
		'is_admin' => false,
		'can_access_level1' => true,
		'can_access_level2' => false,
		'can_access_level3' => false,
	];
}

?>