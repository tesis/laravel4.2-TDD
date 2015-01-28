<?php namespace Tesis\Storage\User;

    use Tesis\Storage\User\UserRepositoryInterface;
    use User;

    class EloquentUserRepository implements UserRepositoryInterface {
        public function find($id)
        {
            $user = User::find($id);
            if(!$user) throw new NotFoundException('User Not Found');
            return $user;
        }
        public function all()
        {
            $users = User::all();
            if(!$users) throw new NotFoundException('Users Not Found');
            return $users;
        }
        public function create($input)
        {
            $user = User::create($input);
            return $user;
        }

        public function update($id)
        {
            $user = $this->find($id);
            $user->save(Input::all());
            return $user;
        }
        public function delete($id)
        {
            $user = $this->find($id);
            $user->delete();
            return true;
        }
        public function validate($input, $id='')
        {
            $user = $this->instance($input);

            return $user->isValid();

        }
        public function instance($data = array())
        {
            return new User($data);
        }

    }
