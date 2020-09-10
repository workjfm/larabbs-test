<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
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

    /**
     * 用户编辑页面
     * @param User $user
     * @return Factory|ViewAlias
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * 编辑
     * @param UserRequest $request
     * @param User $user
     * @return RedirectResponseAlias
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
