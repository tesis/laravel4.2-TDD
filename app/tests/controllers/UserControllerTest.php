<?php // app/tests/controllers/UserControllerTest.php


use \Mockery as m;

class UserControllerTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->mock = $this->mock('Tesis\Storage\User\UserRepositoryInterface');
    }
    public function tearDown()
    {
        m::close();
    }

    /**
    *
    * mock
    *
    * mock the object
    * $this->mock as an instance when we need an instance of User
    * providing an instance of User as mocked version
    *
    */
    public function mock($class)
    {
        $mock = m::mock($class);
        $this->app->instance($class, $mock);
        return $mock;
    }
    /**
    *
    * testIndex: check if responce is ok
    * and users are prepared to be passed to the view
    *
    */

    public function testIndex()
    {

        $this->mock->shouldReceive('all')->once();

        $this->call('GET', 'users');

        $this->assertResponseOk();

        $this->assertViewHas('users');
    }

    /**
    *
    * testIndexPassVariablesToTheViewIsolateEloquent
    *       test if variables that should be passed to the view exists
    *       ($users)
    *
    */

    public function testIndex_Pass_Variables_To_The_View_Isolate_Eloquent()
    {
        $this->mock
             ->shouldReceive('all')
             ->once()
             ->andReturn('called');//this can be ommitted
            //we just need to prevent hitting the database
            //and make sure that method 'all' was triggered

        $this->call('GET','users');
        //check if an array of users exists to be passed to the view
        $this->assertViewHas('users');
    }


    /**
    *
    * testCreatePass - display form
    * we have only one variable to pass to view: title
    *
    */

    public function testCreate_Expected_Pass()
    {
        $this->call('GET', route('users.create'));

        $this->assertResponseOk();
        //test if title is defined and prepared for views
        $this->assertViewHas('title');

    }
    /**
     * testShow
     *
     * test if show method exists
     * and all parameters prepared
     *
     */

    public function testShow()
    {
        $userId = '1';
        $this->mock
            ->shouldReceive('find')
            ->once()
            ->with($userId);

        //var_dump($this->mock->find($userId));

        $this->call('GET', 'users/' .$userId);

        $this->assertResponseOk();
    }

    /**
     * testEdit
     *
     */
    public function testEdit()
    {
        $this->call('GET', 'users/1/edit');

        $this->assertResponseOk();
    }
    /**
     * testing redirections
     *
    */

    /**
    *
    * testStore_Expected_Fail
    *
    */
    public function testStore_Expected_Fail()
    {
        $this->mock->shouldReceive('validate')
             ->once()
             ->andReturn(false);
        $this->call('POST', 'users');

        $this->assertRedirectedToRoute('users.create');

    }

    /**
    *
    * testStore_Expected_Pass
    *
    */
    public function testStore_Expected_Pass()
    {
        Input::replace(['name' => 'test', 'email' => 'test@test12.com', 'password' => 'ssssss', 'password_confirmation' => 'ssssss']);
        $this->mock ->shouldReceive('validate')
                    ->once()
                    ->andReturn(true);

        $this->mock ->shouldReceive('create')
                    ->once()
                    ->andReturn(true);

        $this->call('POST', 'users');
        $this->assertRedirectedToRoute('users.index');
        $this->assertSessionHas('flash');
    }

    /**
    *
    * testUpdate_Expected_Pass
    *
    */
    public function testUpdate_Expected_Pass()
    {
        $this->mock->shouldReceive('update')
                    ->once()
                    ->with(1)
                    ->andReturn(Mockery::mock(array(
                        'saved' => false,
                        'errors' => array()
                      )));

        $this->call('PUT', 'users/1');

        $this->assertRedirectedToRoute('users.edit', 1);
        $this->assertSessionHasErrors();

    }

    /**
    *
    * testUpdate_Expected_Fail
    *
    */
    public function testUpdate_Expected_Fail()
	{
        $this->mock->shouldReceive('update')
             ->once()
             ->with(1)
             ->andReturn(Mockery::mock(array(
                 'saved' => false,
                 'errors' => array()
               )));

        $this->call('PUT', 'users/1');

        $this->assertRedirectedToRoute('users.edit', 1);
        $this->assertSessionHasErrors();

	}

}
