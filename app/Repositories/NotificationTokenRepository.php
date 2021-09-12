<?php


namespace App\Repositories;
use App\IRepositories\INotificationTokenRepository;
use App\Models\NotificationToken;
use App\Models\DeviceGroup;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
class NotificationTokenRepository implements INotificationTokenRepository
{

    /**
     * @inheritDoc
     */
    public function saveUserToken($user_id, $token)
    {
        // verificar si el id usuario existe en la tabla de grupos
        $userRegister = DeviceGroup::where('user_id', $user_id)->first();
        // si no existe crear un keyname y grupo con ese token
        if(is_null($userRegister)) {
            $user = User::find($user_id);
            // creo un key name unico solo cundo no se ha registrado
            $notification_key_name = $user->name."-".$user_id;
        $nuevoGrupo = Http::withHeaders([
                'Authorization' => env('FCM_KEY'),
                'project_id' => env('PROJECT_ID')
            ])->acceptJson()->post('https://fcm.googleapis.com/fcm/notification',
                [
                    "operation"=>"create",
                    "notification_key_name" => $notification_key_name,
                    "registration_ids" => [$token]
                ]);
        //creamos el grupo
            $deviceGroup = DeviceGroup::create([
                'user_id'=>$user_id,
                'notification_key_name'=>$notification_key_name,
                'notification_key'=>$nuevoGrupo->object()->notification_key,
            ]);
            //registramos
            NotificationToken::create([
                'device_groups_id' => $deviceGroup->id,
                'token' => $token,
            ]);
        }
//        //si existe hacer una petticion para agregar ese nuevo token
//        else{
//
//        }
//                   $rules = [
//               'token' => ['required','unique:notification_tokens']
//           ];
//           $validator = Validator::make([$user_id, $token], $rules);
//           if ($validator->fails()) {
//               return response()->json($validator->errors()->all());
//
//           }
        $userToken = new NotificationToken();
        $userToken->user_id =$user_id;
        $userToken->token = $token;
         return  $userToken->saveOrFail();
    }
}
