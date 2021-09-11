<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessages;
use App\IRepositories\INotificationTokenRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationTokenController extends Controller
{
    protected $INotificationTokenRepository;
    function __construct(INotificationTokenRepository $INotificationTokenRepository){
        $this->middleware('auth:api');
        $this->INotificationTokenRepository = $INotificationTokenRepository;
    }

    public function saveUserToken(Request $request){
        $rules = [
            'token' => ['required','unique:notification_tokens']
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors()->all());

        }
        $userToken = $this->INotificationTokenRepository->saveUserToken($request->user_id,$request->token);
        return response()->json($userToken);
    }
}
