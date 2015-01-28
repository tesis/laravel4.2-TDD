<?php // app/models/User.php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Support\Facades\Hash;

class User extends BaseModel implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password', 'password_confirmation'];
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public function rules($id = '')
    {
        $rules = [
                    'name' => 'required|min:3',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|alpha_num|between:6,12',
                    'password_confirmation' => 'same:password|required|alpha_num|between:6,12',
                ];
        if(!empty($id))
        {
            $rules['email'].= ",$id";
            unset($rules['password']);
            unset($rules['password_confirmation']);
        }

        return $rules;
    }
    public function hashPassword($password)
    {
        return Hash::make($password);
    }

}
