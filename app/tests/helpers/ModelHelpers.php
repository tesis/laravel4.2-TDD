<?php // app/tests/helpers/ModelHelpers.php

trait ModelHelpers {
    public function assertValid($model)
    {
        $this->assertTrue( $model->isValid(), 'Model did not pass validation.');
    }

    public function assertNotValid($model)
    {
        $this->assertNotEquals( true, $model->isValid(),'Did not expect model to pass validation.');
    }

}
