<?php

namespace App\Repositories;

interface BaseRepositoryInterface
{
    function show($id);
    function store($data);
}