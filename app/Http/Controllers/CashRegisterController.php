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
    function registersXUser($id){
        try{
            $cashRegister = $this->ICashRegisterRepository->registersXUser($id);
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

    function show($id){
        try{
            $detailRegisters = $this->ICashRegisterRepository->getDetailRegister($id);
            if(!is_null($detailRegisters)){
                return new CashRegisterResource($detailRegisters);
            }
            else{
                return response()->json(['messages'=>ResponseMessages::GET_RESOURCE_VOID()]);
            }
        }catch(Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500().$e);
            return response()->json(['get'=>false],500);
        }
    }
    function RegisterWithVoucher($id){
        try{
            $detailRegisters = $this->ICashRegisterRepository->getRegisterWithVoucher($id);
            if(!is_null($detailRegisters)){
                return response()->json($detailRegisters);
            }
            else{
                return response()->json(['messages'=>ResponseMessages::GET_RESOURCE_VOID()]);
            }
        }catch(Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500().$e);
            return response()->json(['get'=>false],500);
        }
    }

    public function getRegistersXUser($id)
    {
        try{
            $RegistersXUser = $this->ICashRegisterRepository->getRegistersXUser($id);
            if(!is_null($RegistersXUser)){
                return new CashRegisterResource($RegistersXUser);
            }
            else{
                return response()->json(['messages'=>ResponseMessages::GET_RESOURCE_VOID()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500().$e);
            return response()->json(['get'=>false],500);
        }
    }
}
