<?php //app/tests/models/BaseModelTest.php

class BaseModelTest extends TestCase {


    protected $model;

    public function setUp()
    {
        parent::setUp();

        $this->model = $model = new BaseModel;
        $model::$rules = ['title' => 'required'];

    }


    /**
    *
    * @test_Returns_True_If_Validation_Passes
    *
    */
    public function test_Returns_True_If_Validation_Passes()
    {

        $this->model->title = 'Foo Title';
        $result = $this->model->isValid();

        $this->assertEquals(true, $result);

    }

    /**
    *
    * test_Sets_Errors_On_Object_If_Validation_Fails
    *
    */
    public function test_Sets_Errors_On_Object_If_Validation_Fails()
    {
        Validator::shouldReceive('make')
                    ->once()
                    ->andReturn(Mockery::mock(['passes' => false, 'messages' => 'messages'])
        );

        $result = $this->model->isValid();
        $this->assertEquals('messages', $this->model->errors);

    }

}
