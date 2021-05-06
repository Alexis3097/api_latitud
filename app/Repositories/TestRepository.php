<?php
namespace App\Repositories;
use App\IRepositories\ITestRepository;
use App\Models\Test;

class TestRepository implements ITestRepository
{

    public function all()
    {
        return Test::paginate(10);
    }

    public function create($data): bool
    {
        return Test::saveOrFail($data);
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function update($data, $id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
