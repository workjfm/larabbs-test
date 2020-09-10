<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View as ViewAlias;

class UsersController extends Controller
{
    /**
     * 用户详情页
     * @param User $user
     * @return Factory|ViewAlias
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }


}
