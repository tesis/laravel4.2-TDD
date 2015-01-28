<?php //app/models/BaseModel.php


class BaseModel extends Eloquent
{
    public $errors;
    public static $rules = [];

    public function rules()
    {
        return $rules = [];
    }

    /**
     * get the unique identifier for the user
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
	/**
	 * Returns the date of the blog post creation,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function created_at()
	{
		return date('d-m-Y H:i', strtotime($this->created_at));
	}

	/**
	 * Returns the date of the blog post last update,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function updated_at()
	{
        return date('d-m-Y H:i', strtotime($this->updated_at));
	}

    /**
     * validate input
     *
     * @return 
     */
    public function isValid($id = '')
    {

        $validation = Validator::make($this->attributes, $this->rules($id));

        if($validation->passes()) return true;
        $this->errors = $validation->messages();
        return $this->errors;
    }

}
