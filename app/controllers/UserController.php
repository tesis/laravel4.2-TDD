<?php //app/controllers/UserController.php

use Tesis\Storage\User\UserRepositoryInterface as User;

class UserController extends \BaseController {

    protected $user;

    /**
    * Inject the User Repository
    */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = $this->user->all();

        return View::make('users.index')->withUsers($users);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $title = "Create User";
		return View::make('users.create', ['title'=>$title]);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $input = Input::all();

        $v = $this->user->validate($input);

        if($v === true)
        {

            $input['name'] = Input::get('name');
            $input['email'] = Input::get('email');
            $input['password'] = Hash::make(Input::get('password'));
            $input['password_confirmation'] = Input::get('password_confirmation');
            unset($input['password_confirmation']);

            $create = $this->user->create($input);
            return Redirect::route('users.index')
                            ->with('flash', 'User has been successfully created');
        }

        return Redirect::route('users.create')
                            ->withInput()->withErrors($v);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return $this->user->find($id);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('users.edit');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $user = $this->user->update($id);

        if($user->saved())
        {
            return Redirect::route('users.show', $id)
                                    ->with('flash', 'The user was updated');
        }

        return Redirect::route('users.edit', $id)
                                ->withInput()
                                ->withErrors($user->errors());
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return $this->user->delete($id);
	}


}
