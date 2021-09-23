<?php

namespace App\Http\Controllers;

use App\Models\AmountAssigned;
use App\Models\DeviceGroup;
use App\Models\Notification;
use App\Models\User;
use App\Models\Voucher;
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
//        $vouchers = Voucher::where('approve',true)->where('photoId','!=',null)->get();
//        if($vouchers->count() > 0){
//            foreach ($vouchers as $voucher){
//                if($voucher->created_at->diffInDays() > 7){
//                    //eliminar la foto
//                    cloudinary()->destroy($voucher->photoId);
//                }
//            }
//
//        }

        $users = User::where('user_type_id','!=',1)->get('id');
        if($users->count() > 0){
            foreach ($users as $user){
                $this->sendNotification($user->id);
            }
        }
        return response()->json('ok');

    }

    public function sendNotification($user_id){
        try{
            $deviceGroupRegister = DeviceGroup::where('user_id', $user_id)->first();
            if(!is_null($deviceGroupRegister)){
                $response = Http::withHeaders([
                    'Authorization' => env('FCM_KEY')
                ])->acceptJson()->post('https://fcm.googleapis.com/fcm/send',
                    [
                        "notification"=>[
                            "title"=>"Recordatorio",
                            "body"=>"Debes hacer tus comprobantes de pago antes del fin de mes"
                        ],
                        "priority"=>"high",
                        "to"=>$deviceGroupRegister->notification_key
                    ]);
            }
        }catch (\Exception $e){

        }
    }


}
