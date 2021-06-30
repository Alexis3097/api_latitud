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


    public function create($data)
    {
        return Test::create($data);
    }

    public function show($id)
    {
        return Test::find($id);
    }

    public function update($data, $id)
    {
        $test = Test::find($id);
        $test->fill($data);
        return $test->save();
    }

    public function delete($id)
    {
        $test =  Test::find($id);
        $test->delete();
        return $test;
    }

}
