<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessages;
use App\Http\Resources\CashRegisterResource;
use App\IRepositories\ICashRegisterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
class CashRegisterController extends Controller
{
    protected $ICashRegisterRepository;
    function __construct(ICashRegisterRepository $ICashRegisterRepository)
    {
        $this->middleware('auth:api');
        $this->ICashRegisterRepository = $ICashRegisterRepository;
    }

    function index(){
       try{
            $cashRegister = $this->ICashRegisterRepository->all();
           if(!is_null($cashRegister)){
        return response()->json($cashRegister);
               return CashRegisterResource::collection($cashRegister);
           }
           else{
               return response()->json(['messages'=> ResponseMessages::GET_RESOURCES_VOID()]);
           }
       }catch (Throwable $e){
           Log::info(ResponseMessages::GET_RESOURCES_FAILED_500() .$e);
           return response()->json(['get'=>false],500);
       }
    }
    function registersCajaChia(){
        try{
            $cashRegister = $this->ICashRegisterRepository->registersCajaChia();
            if(!is_null($cashRegister)){
                return CashRegisterResource::collection($cashRegister);
            }
            else{
                return response()->json(['messages'=> ResponseMessages::GET_RESOURCES_VOID()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500() .$e);
            return response()->json(['get'=>$e],500);
        }
    }
}
