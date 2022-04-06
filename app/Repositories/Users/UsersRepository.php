<?php

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\BaseRepository;

class UsersRepository extends BaseRepository implements UsersInterface
{
    /**
    * @var ModelName
    */
    protected $model;

    public function __construct(User $model)
    {
      $this->model = $model;
    }

    public function listUsers()
    {
      return $this->model->paginate(5);
    }

    public function registerUsers(array $data)
    {
      return $this->model->create($data);
    }
    
    public function approveUsers($id)
    {
      return $this->model->findOrFail($id)->update([
        'is_registered' => true
      ]);
    }

    public function rejectOrDeleteUsers($id)
    {
      return $this->model->findOrFail($id)->delete();
    }

    public function detailUsers($id)
    {
      return $this->model->findOrFail($id);
    }
}