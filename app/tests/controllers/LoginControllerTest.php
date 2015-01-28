<?php // app/tests/controllers/LoginControllerTest.php

//return $this->call($method, $args[0]);
//localhost:8000/users

use \Mockery as m;

class LoginControllerTest extends TestCase
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
     * mock the object
     * tell to Laravel to user $this->mock as an instance
     * when we need an instance of User
     * provide an instance of User as mocked version
     */
    public function mock($class)
    {
        $mock = m::mock($class);
        $this->app->instance($class, $mock);
        return $mock;
    }
    /**
    *
    * testCreate: test response
    *
    */

    public function testCreate()
    {
        $this->call('GET', 'login');

        $this->assertResponseOk();
    }
    /**
     * Test Store failure
     */
    public function testStore_Expected_Fail()
    {
        Auth::shouldReceive('attempt')->andReturn(false);

        $this->call('POST', 'login');

        $this->assertRedirectedToRoute('login.create');
        $this->assertSessionHas('flash');
    }
    /**
     * Test Store success
     */
    public function testStore_Expected_Pass()
    {
        Auth::shouldReceive('attempt')->andReturn(true);

        $this->call('POST', 'login');

        $this->assertRedirectedToRoute('users.index');
    }
    /**
    *
    * Test destroy
    *
    */

    public function testDestroy()
    {
        $this->call('POST', 'login');
        $this->assertRedirectedToRoute('login.create');
        $this->assertFalse(Auth::check());
    }

}
