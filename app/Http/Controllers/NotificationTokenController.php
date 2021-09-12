<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessages;
use App\IRepositories\INotificationTokenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
class NotificationTokenController extends Controller
{
    protected $INotificationTokenRepository;
    function __construct(INotificationTokenRepository $INotificationTokenRepository){
        $this->middleware('auth:api');
        $this->INotificationTokenRepository = $INotificationTokenRepository;
    }

    public function saveUserToken(Request $request){
       try{

           $userToken = $this->INotificationTokenRepository->saveUserToken($request->user_id,$request->token);
           return response()->json($userToken);
//           if($userToken){
//               return response()->json(ResponseMessages::POSTSUCCESSFUL());
//           }else{
//               return response()->json(ResponseMessages::STORE_FAILED_400());
//           }
       }catch (Throwable $e){
           Log::info(ResponseMessages::STORE_FAILED_500().$e);
           return response()->json($e);
//           return response()->json(['store'=>ResponseMessages::STORE_FAILED_500().$e],500);
       }


    }
}
