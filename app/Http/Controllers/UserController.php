<?php

namespace App\Http\Controllers;

use App\Repositories\Users\UsersInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $users;

    public function __construct(UsersInterface $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        $users = $this->users->listUsers();
        return view('pages.users.index', compact('users'));
    }

    public function detail($id)
    {
        $user = $this->users->detailUsers($id);
        return response()->json([
            'status'    => true,
            'data'      => $user,
        ]);
    }

    public function update($id)
    {
        $this->users->approveUsers($id);
        return response()->json([
            'success'   => true,
        ]);
    }

    public function reject($id)
    {
        $this->users->rejectOrDeleteUsers($id);
        return response()->json([
            'success'   => true,
        ]);
    }

}
