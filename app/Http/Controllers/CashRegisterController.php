<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessages;
use App\Http\Resources\CashRegisterResource;
use App\IRepositories\IBoxRepository;
use App\IRepositories\ICashRegisterRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
class CashRegisterController extends Controller
{
    protected $ICashRegisterRepository;
    protected $IBoxRepository;
    function __construct(ICashRegisterRepository $ICashRegisterRepository, IBoxRepository $IBoxRepository)
    {
        $this->middleware('auth:api');
        $this->ICashRegisterRepository = $ICashRegisterRepository;
        $this->IBoxRepository = $IBoxRepository;
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
           return response()->json(['index'=>false],500);
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
            return response()->json(['registersXUser'=>$e],500);
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
            return response()->json(['show'=>false],500);
        }
    }
    function RegisterWithVoucher($id){
        try{
            $detailRegisters = $this->ICashRegisterRepository->getRegisterWithVoucher($id);
            if(!is_null($detailRegisters)){
                return new CashRegisterResource($detailRegisters);
            }
            else{
                return response()->json(['messages'=>ResponseMessages::GET_RESOURCE_VOID()]);
            }
        }catch(Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500().$e);
            return response()->json(['RegisterWithVoucher'=>false],500);
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
            return response()->json(['getRegistersXUser'=>false],500);
        }
    }
    public function getRegistersXCajaChica($id)
    {
        try{
            $registersXCajaChica = $this->ICashRegisterRepository->getRegistersXCajaChica($id);
            if(!is_null($registersXCajaChica)){
                return new CashRegisterResource($registersXCajaChica);
            }
            else{
                return response()->json(['messages'=>ResponseMessages::GET_RESOURCE_VOID()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500().$e);
            return response()->json(['getRegistersXCajaChica'=>false],500);
        }
    }
    public function voidRegistration(Request $request)
    {
        try{
           //eliminamos el registro y nos devuelve el monto que se cancelo
            $amount = $this->ICashRegisterRepository->delete($request->idRegister);
            //disminuimos el dinero de un usuario en concreto
            $box = $this->IBoxRepository->approveExpense($request->idDestination, $amount);
            if(!is_null($box)){
                return response()->json(['messages'=>ResponseMessages::DESTROY_SUCCESS()]);
            }else{
                return response()->json(['messages'=>ResponseMessages::DESTROY_FAILED_400()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::DESTROY_FAILED_500().$e);
            return response()->json(['voidRegistration'=>false],500);
        }
    }
}
