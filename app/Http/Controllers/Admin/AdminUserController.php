<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdminUserController extends Controller
{
    public function index()
    {
        if(!$users = User::with('roles')->paginate(10))
        {
            throw new NotFoundHttpException('Users not found');
        }

        return $users;
    }
}
