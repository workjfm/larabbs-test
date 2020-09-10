<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
use Illuminate\View\View as ViewAlias;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

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
     * @throws AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit', compact('user'));
    }

    /**
     * 编辑个人信息
     * @param UserRequest $request
     * @param User $user
     * @param ImageUploadHandler $uploadHandler
     * @return RedirectResponseAlias
     * @throws AuthorizationException
     */
    public function update(UserRequest $request, User $user, ImageUploadHandler $uploadHandler)
    {
        $this->authorize('update', $user);
        $data = $request->all();

        if ($request->hasFile('avatar')) {
            $result = $uploadHandler->save($request->avatar, 'avatars', $user->id, 416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
}
