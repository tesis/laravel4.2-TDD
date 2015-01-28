<?php //app/controllers/LoginController.php

use Tesis\Storage\User\UserRepositoryInterface as User;

class LoginController extends \BaseController {

    /**
    * User Repository
    */
    protected $user;

    /**
    * Inject the User Repository
    */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
	/**
	 * Display a login form.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.login');
	}

	/**
	 * Login if authorized
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
        {
            return Redirect::intended('/users')->with('flash_message', 'You are logged in');
        }
        return Redirect::route('login.create')
                ->withInput()
                ->with('flash_message', 'Invalid credentials');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();

        return Redirect::intended('/login')->with('flash_message', 'You are logged out');
	}


}
