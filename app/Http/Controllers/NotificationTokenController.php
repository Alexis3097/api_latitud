<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessages;
use App\IRepositories\INotificationTokenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;
use Illuminate\Support\Facades\Validator;
class NotificationTokenController extends Controller
{
    protected $INotificationTokenRepository;
    function __construct(INotificationTokenRepository $INotificationTokenRepository){
        $this->middleware('auth:api');
        $this->INotificationTokenRepository = $INotificationTokenRepository;
    }

    public function saveUserToken(Request $request){
       try{
           $rules = [
               'token' => ['required','unique:notification_tokens']
           ];
           $validator = Validator::make($request->all(), $rules);
           if ($validator->fails()) {
               return response()->json($validator->errors()->all());

           }
           $userToken = $this->INotificationTokenRepository->saveUserToken($request->user_id,$request->token);
           if(!is_null($userToken)){
               return response()->json(ResponseMessages::POSTSUCCESSFUL());
           }else{
               return response()->json(ResponseMessages::STORE_FAILED_400());
           }
       }catch (Throwable $e){
           Log::info(ResponseMessages::STORE_FAILED_500().$e);
           return response()->json(['store'=>ResponseMessages::STORE_FAILED_500().$e],500);
       }


    }

    public function deleteUserToken(Request $request){
        try{
            $userToken = $this->INotificationTokenRepository->deleteUserToken($request->user_id,$request->token);
            return response()->json($userToken);
            if($userToken){
                return response()->json(ResponseMessages::POSTSUCCESSFUL());
            }else{
                return response()->json(ResponseMessages::STORE_FAILED_400());
            }
        }catch (Throwable $e){
            Log::info(ResponseMessages::STORE_FAILED_500().$e);
            return response()->json(['store'=>ResponseMessages::STORE_FAILED_500().$e],500);
        }
    }
}
