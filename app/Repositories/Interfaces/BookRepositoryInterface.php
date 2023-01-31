<?php


namespace App\Repositories\Interfaces;


use App\Models\Book;

interface BookRepositoryInterface
{
    public function getAll(array $params = null);

    public function getAllDesc();

    public function getById($id);

    public function store(array $data);

    public function update(array $data, $id);

    public function delete($id);
}
