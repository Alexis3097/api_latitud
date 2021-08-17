<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\ResponseMessages;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\UserResource;
use App\IRepositories\IUserRepository;
use Throwable;

class UserController extends Controller
{
    protected $IUserRepository;
    function __construct(IUserRepository $IUserRepository)
    {
        $this->middleware('auth:api');
        $this->IUserRepository = $IUserRepository;
    }

    public function index(){
        try{
            $usuarios = $this->IUserRepository->all();
            if(!is_null($usuarios)){
                return UserResource::collection($usuarios);
            }
            else{
                return response()->json(['messages'=> ResponseMessages::GET_RESOURCES_VOID()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500() .$e);
            return response()->json(['get'=>false],500);
        }
    }

    public function getCoordinadores(){
        try{
            $coordinadores = $this->IUserRepository->getCoordinadores();
            if(!is_null($coordinadores)){
                   return UserResource::collection($coordinadores);
            }
            else{
                return response()->json(['messages'=> ResponseMessages::GET_RESOURCES_VOID()]);
            }
        }catch(Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500() .$e);
            return response()->json(['get'=>false],500);
        }
    }

    public function store(Request $request){
        try {
            $user = $this->IUserRepository->create($request);
            return response()->json(['error'=>$user]);
//            if(!is_null($user)){
//                return response()->json(['messages'=>ResponseMessages::POSTSUCCESSFUL()]);
//            }else{
//                return response()->json(['messages'=>ResponseMessages::STORE_FAILED_400()]);
//            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::STORE_FAILED_500().$e);
            return response()->json(['errorCatch'=>$e]);
        }
    }

    public function onlyUser(){

        try{
            $users = $this->IUserRepository->onlyUsers();
            if(!is_null($users)){
                return UserResource::collection($users);
            }
            else{
                return response()->json(['messages'=> ResponseMessages::GET_RESOURCES_VOID()]);
            }
        }catch(Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500() .$e);
            return response()->json(['get'=>false],500);
        }

    }
}
