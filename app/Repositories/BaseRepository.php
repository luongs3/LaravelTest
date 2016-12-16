<?php
/**
 * Created by PhpStorm.
 * User: luongs3
 * Date: 1/30/2016
 * Time: 10:38 AM
 */
namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use DB;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function show($id)
    {
        try {
            $data = $this->model->find($id);

            if (!$data) {
                return ['error' => trans('message.item_not_exist')];
            }

            return $data;
        } catch (Exception $ex) {
            return ['error' => $ex->getMessage()];
        }
    }

    public function store($input)
    {
        try {
            $data = $this->model->create($input);

            if (!$data) {
                return ['error' => trans('message.creating_error')];
            }

            return $data;
        } catch (Exception $ex) {
            return ['error' => $ex->getMessage()];
        }
    }
}
