<?php // app/tests/models/UserTest.php


use \Mockery as m;

class UserTest extends TestCase {
    //use traits
    use ModelHelpers;

    protected $user;


    public function setUp()
    {
        parent::setUp();
        //cleans up the database - run only when you want to have clean database
        //-Artisan::call('migrate:refresh');
        //-$this->seed();

    }
    public function tearDown()
    {
        m::close();
    }

    //xxx: step by step testing, before each rule is setup
    //once established all rules this have to be omitted
    //validation return true/array of errors
    /**
    *
    * test_Empty_Name_Expected_Fail
    *
    */
    public function test_Empty_Name_Expected_Fail()
    {
        $user = new User;
        $user->name = '';
        $user->email = 'ddd@test.si';
        $user->password = 'test123';
        $user->password_confirmation = 'test123';

        $result = $user->isValid();

        //one or another assert to test
        $this->assertNotEquals(true, $result);
        $this->assertFalse(false,'Expected validation to fail.');

        return $user;
    }

    /**
    *
    * test_Name_Has_Less_Chars_Than_Defined_Expected_Fail
    *
    */
    public function test_Name_Has_Less_Chars_Than_Defined_Expected_Fail()
    {
        $user = new User;
        $user->name = 'ab';
        $result = $user->isValid();

        $this->assertNotEquals(true, $result);
        $this->assertFalse(false,'Expected validation to fail.');

        return $user;
    }


    /**
    *
    * test_Email_Is_Unique_Expected_Fail
    *
    */
    public function test_Email_Is_Unique_Expected_Fail()
    {
        //email exists in db - if not insert new user with this credentials
        /*$user = new User;
        $user->name = 'abcd';
        $user->email = 'ddd@test.si';
        $user->password = 'test123';
        $user->save();*/

        $user = new User;
        $user->name = 'abcd';
        $user->email = 'ddd@test.si';
        $user->password = 'test123';
        $user->password_confirmation = 'test123';

        $this->assertNotValid($user);
    }
    /**
    *
    * test_Password_Not_Empty_Required_Expected_Fail
    *
    */
    public function test_Password_Not_Empty_Required_Expected_Fail()
    {
        $user = new User;
        $user->name = 'abcd';
        $user->email = 'ddd@test7.si';
        $user->password = '';

        $this->assertNotValid($user);
    }
    /**
    *
    * test_Password_Not_Empty_CharCount_Expected_Fail
    *
    */
    public function test_Password_Not_Empty_CharCount_Expected_Fail()
    {
        $user = new User;
        $user->name = 'abcd';
        $user->email = 'ddd@test9.si';
        $user->password = 'sfsdf';

        $this->assertNotValid($user);
    }
    /**
    *
    * test_Password_Special_Chars_Included_Expected_Fail
    *
    */
    public function test_Password_Special_Chars_Included_Expected_Fail()
    {
        $user = new User;
        $user->name = 'abcd';
        $user->email = 'ddd@test7.si';
        $user->password = 'sfsdf*';

        $this->assertNotValid($user);
    }
    /**
    *
    * test_Password_Confirm_Empty_Expected_Fail
    *
    */
    public function test_Password_Confirm_Empty_Expected_Fail()
    {
        $user = new User;
        $user->name = 'abcd';
        $user->email = 'ddd@test8.si';
        $user->password = 'test123';
        $user->password_confirmation = '';

        $this->assertNotValid($user);

    }
    /**
    *
    * @test_Password_Confirm_Does_Not_Match_Expected_Fail
    *
    */
    public function test_Password_Confirm_Does_Not_Match_Expected_Fail()
    {
        $user = new User;
        $user->name = 'abcd';
        $user->email = 'ddd@test8.si';
        $user->password = 'test123';
        $user->password_confirmation = 'sdfsd';

        $this->assertNotValid($user);

    }
    /**
    *
    * test_New_User_Is_Valid__Expected_Pass
    *
    */
    public function test_New_User_Is_Valid__Expected_Pass()
    {
        $user = new User;
        $user->name = 'abcd';
        $user->email = 'ddd3@test8.si';
        $user->password = 'testdddd';
        $user->password_confirmation = 'testdddd';

        $this->assertValid($user);
        //same way of testing:
        $this->assertEquals(true, $user->isValid());
        $this->assertTrue($user->isValid(), 'Expected validation to pass.');

    }
    /**
   * @param $name
   * @param $email
   * @param $password
   * @param $pasword_confirmation
   * @param $expected
   *
   * @dataProvider userProvider
   *
   * step-by-step validation only on first phase, when building a class, then we can use user providers
   * with this test, other tests can be omitted
   * hashing password-comment out, without mocking it, we'll receive always false
   */
    public function test_All_Required_Fields_Expected_Validation($name, $email, $password, $password_confirmation,$expected)
    {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        $user->password_confirmation = $password_confirmation;
        $actual = $user->isValid();
        $this->assertNotEquals($expected, $actual);
    }
    /**
    *
    * userProvider
    * a provider for test_All_Required_Fields_Expected_Validation
    *
    */
    public static function userProvider()
    {
        return array(
          //password matches, required, min 6-12
          array('name', 'email@test.si', 'password', '', false),
          array('name', 'email@test.si', '', 'password', false),
          array('name', 'email@test.si', '', '', false),
          array('name', 'email@test.si', 'pass', 'pass', false),
          //name required, min 3
          array('', 'email@test.si', 'password', 'password', false),
          array('na', 'email@test.si', 'password', 'password', false),
          //email required, valid
          array('name', '', 'password', 'password', false),
          array('name', 'email', 'password', 'password', false),

        );
    }
    /**
    *
    * test_Hashed_Password_Expected_Pass
    *
    */
    public function test_Hashed_Password_Expected_Pass()
    {

        $password = Hash::make('password');
        $new_password = Hash::make('password');

        Hash::check('password', $password); // true
        Hash::check('password', $new_password); // true

        $this->assertEquals(true, Hash::check('password', $new_password), 'Expected to pass');
        $this->assertEquals(true, Hash::check('password', $password), 'Expected to pass');

    }
    /**
    *
    * test_Update_Existing_User_Without_Dependencies
    *
    */
    public function test_Update_Existing_User_Without_Dependencies()
    {
        $user = User::find(1);
        $result = $user->id;
        $this->assertEquals(true, $result);
        $user->name = 'test update';
        $user->email = 'ddd@test.si';
        $user->save();

        $this->assertTrue($user->isValid($user->id), 'Expected to pass');
    }

    /**
    *
    * test_Find_User_Expected_Pass
    * test in controller / database - it is a good practice
    * to isolate Eloquent in controllers
    *
    */
    public function test_Find_User_Expected_Pass()
    {
        $user = User::find(1);
        $result = $user->id;
        $this->assertNotEquals($result, 'Expected to pass');

        return $user;
    }
    /**
     * @depends test_Find_User_Expected_Pass
     *
     * @params $user
     *
     */
    public function test_Update_Existing_User_Expected_Pass($user)
    {

        $user->name = 'test again';
        $user->email = 'ddd@test.si';
        $user->save();

        $this->assertTrue($user->isValid($user->id), 'Expected to pass');
    }


}
