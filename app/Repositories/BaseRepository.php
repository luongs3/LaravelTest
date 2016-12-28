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

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function store($input)
    {
        try {
            $data = $this->model->create($input);

            return $data;
        } catch (Exception $ex) {
            return ['error' => $ex->getMessage()];
        }
    }

    public function setModel($model) {
        $this->model = $model;
    }
}
