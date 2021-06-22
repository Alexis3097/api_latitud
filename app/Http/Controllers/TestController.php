<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessages;
use App\IRepositories\ITestRepository;
use App\Http\Requests\StoreTest;
use App\Http\Resources\TestResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use function PHPUnit\Framework\isEmpty;

class TestController extends Controller
{
    protected $ITestRepository;
    function __construct(ITestRepository $ITestRepository){
//        $this->middleware('auth:api');
        $this->ITestRepository = $ITestRepository;
    }

    public function getApi(){
        return response()->json(['messages'=> 'SI entro la api']);
    }

    public function index()
    {
        try{
            $tests = $this->ITestRepository->all();
            if(!isEmpty($tests)){
                return TestResource::collection($tests);
            }
            else{
                return response()->json(['messages'=> ResponseMessages::GET_RESOURCES_VOID()]);
            }
        }catch(Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500() .$e);
            return response()->json(['get'=>false],500);
        }
    }

    public function store(StoreTest $request)
    {
        try{
            $test = $this->ITestRepository->create($request->all());
            if(!is_null($test)){
                return new TestResource($test);
            }else{
                return response()->json(['messages'=>ResponseMessages::STORE_FAILED_400()]);
            }
        }catch(Throwable $e){
            Log::info(ResponseMessages::STORE_FAILED_500().$e);
            return response()->json(['store'=>false],500);
        }
    }

    public function show($id)
    {
        try{
            $test = $this->ITestRepository->show($id);
            if(!is_null($test)){
                return new TestResource($test);
            }
            else{
                return response()->json(['messages'=>ResponseMessages::GET_RESOURCE_VOID()]);
            }
        }catch(Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500().$e);
            return response()->json(['get'=>false],500);
        }
    }


    public function update(Request $request, $id)
    {
        try{
            $test = $this->ITestRepository->update($request->all(), $id);
            if($test){
                return response()->json(['messages'=>ResponseMessages::UPDATE_SUCCESS()]);
            }
            else{
                return response()->json(['messages'=>ResponseMessages::UPDATE_FAILED_400()]);
            }
        }catch(Throwable $e){
            Log::info(ResponseMessages::UPDATE_FAILED_500().$e);
            return response()->json(['update'=>false],500);

        }
    }

    public function destroy($id)
    {
        try{
            $test = $this->ITestRepository->delete($id);
            if($test){
                return response()->json(['messages'=>ResponseMessages::DESTROY_SUCCESS()]);
            }
            else{
                return response()->json(['messages'=>ResponseMessages::DESTROY_FAILED_400()]);
            }
        }catch(Throwable $e){
            Log::info(ResponseMessages::DESTROY_FAILED_500().$e);
            return response()->json(['destroy'=>false],500);
        }
    }

}
