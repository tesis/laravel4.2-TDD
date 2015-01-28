<?php namespace Tesis\Storage\User;

    interface UserRepositoryInterface {

        public function find($id);
        public function all();
        public function create($input);
        public function update($id);
        public function delete($id);
        public function validate($input, $id='');
        public function instance();
    }
