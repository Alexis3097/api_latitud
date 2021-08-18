<?php

namespace App\Http\Controllers;


use App\Enums\ResponseMessages;
use App\IRepositories\IAmountAssignedRepository;
use Illuminate\Http\Request;
use App\Http\Resources\AmountAssignedResource;
use Illuminate\Support\Facades\Log;
use Throwable;

class AmountAssignedController extends Controller
{

    protected $IAmountAssignedRepository;
    function __construct(IAmountAssignedRepository $IAmountAssignedRepository){
        $this->middleware('auth:api');
        $this->IAmountAssignedRepository = $IAmountAssignedRepository;
    }

    public function index()
    {
        try {
            $AmountAssignees = $this->IAmountAssignedRepository->all();
            if(!is_null($AmountAssignees)){
                return AmountAssignedResource::collection($AmountAssignees);
            }else{
                return response()->json(['messages'=>ResponseMessages::GET_RESOURCES_VOID()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500().$e);
            return response()->json(['get'=>false],500);
        }
    }



    public function store(Request $request)
    {
        try {
            $AmountAssigned = $this->IAmountAssignedRepository->create($request);
            if(!is_null($AmountAssigned)){
                return response()->json(['messages'=>ResponseMessages::POSTSUCCESSFUL()]);
            }else{
                return response()->json(['messages'=>ResponseMessages::STORE_FAILED_400()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::STORE_FAILED_500().$e);
            return response()->json(['store'=>$e],500);
        }
    }


    public function show($id)
    {
        try {
            $AmountAssigned = $this->IAmountAssignedRepository->show($id);
            if (!is_null($AmountAssigned)){
                return new  AmountAssignedResource($AmountAssigned);
            }else{
                return response()->json(['messages'=>ResponseMessages::GET_RESOURCE_VOID()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::GET_RESOURCES_FAILED_500().$e);
            return response()->json(['get'=>false],500);
        }
    }




    public function update(Request $request, $id)
    {
        try {
            $AmountAssigned = $this->IAmountAssignedRepository->update($request->all(),$id);
            if($AmountAssigned){
                return response()->json(['messages'=>ResponseMessages::UPDATE_SUCCESS()]);
            }
            else{
                return response()->json(['messages'=>ResponseMessages::UPDATE_FAILED_400()]);
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::UPDATE_FAILED_500().$e);
            return response()->json(['update'=>false],500);
        }
    }


    public function destroy($id)
    {
        try {
            $AmountAssigned = $this->IAmountAssignedRepository->delete($id);
            if($AmountAssigned){
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
