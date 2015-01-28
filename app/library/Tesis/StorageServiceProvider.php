<?php namespace Tesis\Storage;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider {

  public function register()
  {
    $this->app->bind(
        'Tesis\Storage\User\UserRepositoryInterface',
        'Tesis\Storage\User\EloquentUserRepository'
    );
  }

}
