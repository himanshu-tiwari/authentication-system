<?php

namespace project\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent{
	protected $table = 'users';

	protected $fillable = [
        'email',
        'username',
        'password',
        'first_name',
        'last_name',
        'active',
        'active_hash',
        'recover_hash',
        'remember_identifier',
        'remember_token',
        'profile_id'
	];

    public function isMyId($profile_id){
            if($this->id === $profile_id){
                    return true;
            }

            return false;
    }

    public function getFullName(){
            if(!$this->first_name || !$this->last_name){
                    return null;
            }

            return "{$this->first_name} {$this->last_name}";
    }

    public function getFullNameOrUsername(){
            return $this->getFullName() ?: $this->username;
    }

    public function activateAccount(){
            $this->update([
                    'active' => true,
                    'active_hash' => null
            ]);
   }

   public function getAvatarUrl($options = []){
            $size = isset($options['size']) ? $options['size'] : 45;
            return 'http://www.gravatar.com/avatar/'.md5($this->email).'?s='.$size.'&d=mm';
   }

   public function updateRememberCredentials($identifier, $token){
            $this->update([
                'remember_identifier' => $identifier,
                'remember_token' => $token
            ]);
   }

   public function removeRememberCredentials(){
            $this->updateRememberCredentials(null, null);
   }

   public function searchQuery($value)  {
            return $user = $this->where('username', 'LIKE' , '%' .$value. '%')->get();
   }

   public function hasPermission($permission){
            return (bool) $this->permissions->{$permission};
   }

   public function isAdmin(){
            return $this->hasPermission('is_admin');
   }

   public function permissions(){
            return $this->hasOne('project\User\UserPermission', 'user_id');
   }

   public function isThisUser($value){
            if($this->user == $value){
              return true;
            }
            else{
              //echo $value;
              echo $this->user;
              return false;
            }
   }

   public function isLoggedIn(){
            return $this->logged_in;
   }

   public function updateLogInStatus(){
            if($this->logged_in == 1){
                $this->update([
                  'logged_in' => false
                ]);
            }
            else{
              $this->update([
                'logged_in' =>true
              ]);
            }
   }
}

?>