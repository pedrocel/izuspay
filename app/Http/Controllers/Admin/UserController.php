<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PerfilModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('perfis')->paginate(10);
        $perfis = PerfilModel::all();

        return view('admin.users.index', compact('users', 'perfis'));
    }
}
