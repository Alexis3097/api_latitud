<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessages;
use App\Http\Resources\VoucherResource;
use App\IRepositories\IVoucherRepository;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;
use Throwable;

class VoucherController extends Controller
{
    protected $IVoucherRepository;
    function __construct(IVoucherRepository $IVoucherRepository){
        $this->middleware('auth:api');
        $this->IVoucherRepository = $IVoucherRepository;
    }

    public function index(){
        try {
            $vouchers = $this->IVoucherRepository->all();
            if(!is_null($vouchers)){
                return  VoucherResource::collection($vouchers);
            }else{
                return response()->json(['messages'=>ResponseMessages::GET_RESOURCES_VOID()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500() .$e);
            return response()->json(['get'=>false],500);
        }
    }

    public function store(Request $request){
        try {
            $voucher = $this->IVoucherRepository->create($request);
            if(!is_null($voucher)){
                return new VoucherResource($voucher);
            }else{
                return response()->json(['messages'=>ResponseMessages::STORE_FAILED_400()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::STORE_FAILED_500().$e);
            return response()->json(['store'=>$e],500);
        }
    }

    public function show($id){
        try {
            $voucher = $this->IVoucherRepository->show($id);
            if(!is_null($voucher)){
                return new VoucherResource($voucher);
            }else{
                return response()->json(['messages'=>ResponseMessages::GET_RESOURCE_VOID()]);
            }

        }catch (Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500().$e);
            return response()->json(['get'=>false],500);
        }
    }

    public function update(Request $request, $id){
        try {
            $voucher = $this->IVoucherRepository->update($request->all(),$id);
            if($voucher){
                return response()->json(['messages'=>ResponseMessages::UPDATE_SUCCESS()]);
            }else{
                return response()->json(['messages'=>ResponseMessages::UPDATE_FAILED_400()]);
            }

        }catch (Throwable $e){
            Log::info(ResponseMessages::UPDATE_FAILED_500().$e);
            return response()->json(['update'=>$e],500);
        }
    }

    public function destroy($id){
        try {
            $voucher = $this->IVoucherRepository->delete($id);
            if($voucher){
                return response()->json(['messages'=>ResponseMessages::DESTROY_SUCCESS()]);
            }else{
                return response()->json(['messages'=>ResponseMessages::DESTROY_FAILED_400()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::DESTROY_FAILED_500().$e);
            return response()->json(['destroy'=>false],500);
        }
    }
    public function  getDataSelects(){
        try {
            $expenseType = $this->IVoucherRepository->getExpenseType();
            $checkType = $this->IVoucherRepository->getCheckType();
            return response()->json(['expenseType'=>$expenseType, 'checkType'=>$checkType]);
        }catch (Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500() .$e);
            return response()->json(['get'=>false],500);
        }
    }

}
