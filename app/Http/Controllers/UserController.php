<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessages;
use App\IRepositories\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    protected $IUserRepository;
    function __construct(IUserRepository $IUserRepository)
    {
        $this->middleware('auth:api');
        $this->IUserRepository = $IUserRepository;
    }

    public function getCoordinadores(){
        try{
            $coordinadores = $this->IUserRepository->getCoordinadores();
            if(!isEmpty($coordinadores)){
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


}
