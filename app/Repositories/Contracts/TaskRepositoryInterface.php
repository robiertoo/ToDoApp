<?php

namespace App\Repositories\Contracts;

interface TaskRepositoryInterface
{
    public function findAll();
    public function find($id);
    public function store($request);
    public function update($request, $id);
    public function delete($id);
    public function complete_task($id);
}