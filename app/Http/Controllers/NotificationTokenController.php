<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessages;
use App\Http\Requests\StoreTest;
use App\IRepositories\INotificationTokenRepository;
use Illuminate\Http\Request;

class NotificationTokenController extends Controller
{
    protected $INotificationTokenRepository;
    function __construct(INotificationTokenRepository $INotificationTokenRepository){
        $this->middleware('auth:api');
        $this->INotificationTokenRepository = $INotificationTokenRepository;
    }

    public function saveUserToken(StoreTest $request){

        $validated = $request->messages();
        return response()->json($validated);
//        if ($validated->fails()) {
//            return [
//                'created' => false,
//                'errors'  => $validated->errors()->all()
//            ];
//        }
        $userToken = $this->INotificationTokenRepository->saveUserToken($request->user_id,$request->token);
        return response()->json($userToken);
    }
}
