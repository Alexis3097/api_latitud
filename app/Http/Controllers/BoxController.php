<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessages;
use App\Http\Resources\BoxResource;
use App\IRepositories\IBoxRepository;
use App\IRepositories\IVoucherRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
class BoxController extends Controller
{



    protected $IBoxRepository;
    protected $IVoucherRepository;
    function __construct(IBoxRepository $IBoxRepository, IVoucherRepository $IVoucherRepository)
    {
        $this->middleware('auth:api');
        $this->IBoxRepository = $IBoxRepository;
        $this->IVoucherRepository = $IVoucherRepository;
    }
    function cajaChica(){
        try{
            $box = $this->IBoxRepository->getCajaChica();
            if(!is_null($box)){
                return BoxResource::collection($box);
            }
            else{
                return response()->json(['messages'=> ResponseMessages::GET_RESOURCES_VOID()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500() .$e);
            return response()->json(['get'=>false],500);
        }
    }

    public function approveExpense(Request $request, $idUser){
        try{
//            $box = $this->IBoxRepository->approveExpense($idUser, $request);
            return response()->json([$idUser,$request]);
        }catch (Throwable $e){
            return response()->json($e);
        }
    }
}
