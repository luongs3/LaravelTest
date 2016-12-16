<?php

namespace App\Http\Controllers;

use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;

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

    public function postRegister(Request $request)
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

    public function postLogin(Request $request)
    {
        session_start();
        $user = $request->only([
            'email',
            'password'
        ]);
        $result = $this->userRepository->getUserByEmail($user['email']);

        if (isset($result['error'])) {
            return redirect()->route('users.get-register')->withError($result['error']);
        }

        $_SESSION['user'] = [
            'name' => $result->name,
            'email' => $result->email,
        ];

        return redirect()->route('users.get-register')->withSuccess(trans('messages.login_successfully'));
    }

    public function logout()
    {
        if (isset($_SESSION['user'])) {
            session_start();
            unset($_SESSION['user']);

            return redirect()->route('users.get-login')->withSuccess(trans('messages.logout_successfully'));
        }

        return redirect()->route('users.get-login')->withError(trans('messages.logout_failed'));
    }
}
