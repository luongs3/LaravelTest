<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use Exception;
use Mail;
use DB;
use Carbon\Carbon;
use Auth;
use File;
use Hash;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function getUserByEmail($email)
    {
        try {
            $data = $this->model->where('email', $email)->first();

            if (!$data) {
                return ['error' => trans('messages.item_not_exist')];
            }

            return $data;
        } catch (Exception $ex) {
            return ['error' => $ex->getMessage()];
        }
    }
}
