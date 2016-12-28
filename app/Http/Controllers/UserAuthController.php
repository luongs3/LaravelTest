<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserAuthController extends Controller
{
    protected $userRepository;

    function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getRegister()
    {
        return view('users.auth.register');
    }

    public function postRegister(CreateUserRequest $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password'
        ]);
        $result = $this->userRepository->store($data);

        if (isset($result['error'])) {
            return redirect()->route('users.get-register')->withError($result['error']);
        }

        return redirect()->route('users.get-login')->withSuccess(trans('messages.register_successfully'));
    }

    public function getLogin()
    {
        return view('users.auth.login');
    }

    public function postLogin(UpdateUserRequest $request)
    {
        $user = $request->only([
            'email',
            'password'
        ]);

        $result = $this->userRepository->getUserByEmail($user);

        if (isset($result['error'])) {
            return redirect()->route('users.get-register')->withError($result['error']);
        }

        Session::put('user', [
            'name' => $result->name,
            'email' => $result->email,
        ]);

        return redirect()->route('users.get-register')->withSuccess(trans('messages.login_successfully'));
    }

    /**
     * @codeCoverageIgnore
     */

    public function logout()
    {
        if (\Auth::check()) {
            \Auth::logout();

            return redirect()->route('users.get-login')->withSuccess(trans('messages.logout_successfully'));
        }

        return redirect()->route('users.get-login')->withError(trans('messages.logout_failed'));
    }
}
