<?php

namespace App\Http\Controllers;

use App\IRepositories\ITestRepository;
use Illuminate\Http\Request;

class TestController extends Controller
{
    protected $ITestRepository;
    function __construct(ITestRepository $ITestRepository){
        $this->middleware('auth:api');
        $this->ITestRepository = $ITestRepository;
    }

    public function index()
    {
        try{
            $tests = $this->ITestRepository->all();
            return response()->json($tests, 200);
        }catch(Throwable $e){

        }
    }
}
