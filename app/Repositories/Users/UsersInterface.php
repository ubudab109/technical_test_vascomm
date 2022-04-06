<?php

namespace App\Repositories\Users;

interface UsersInterface
{
  public function listUsers();
  public function registerUsers(array $data);
  public function approveUsers($id);
  public function rejectOrDeleteUsers($id);
  public function detailUsers($id);
}