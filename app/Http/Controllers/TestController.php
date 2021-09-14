<?php

namespace App\Http\Controllers;

use App\Models\DeviceGroup;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Throwable;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Enums\ResponseMessages;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\TestResource;
use App\IRepositories\ITestRepository;
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
            if(!is_null($tests)){
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

    public function show($test)
    {
        try{
            $test = $this->ITestRepository->show($test);
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

    public function  sendNoti(){
       $user = User::where("user_type_id", 8)->get();
       if($user->count() == 0){
           return response()->json('es nullo cuando no tiene contenido');
       }

    }


}
