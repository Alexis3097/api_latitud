<?php
namespace App\Contracts;
interface IBaseRepository
{
    public function all();
    public function create($data);
    public function show($id);
    public function update($data, $id);
    public function delete($id);
}
