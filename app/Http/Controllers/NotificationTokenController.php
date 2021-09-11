<?php

namespace App\Http\Controllers;

use App\Enums\ResponseMessages;
use App\IRepositories\INotificationTokenRepository;
use Illuminate\Http\Request;

class NotificationTokenController extends Controller
{
    protected $INotificationTokenRepository;
    function __construct(INotificationTokenRepository $INotificationTokenRepository){
        $this->middleware('auth:api');
        $this->INotificationTokenRepository = $INotificationTokenRepository;
    }

    public function saveUserToken(Request $request){
        $userToken = $this->INotificationTokenRepository->saveUserToken($request->idUser,$request->token);
        return response()->json($userToken);
    }
}
