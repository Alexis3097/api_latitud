<?php


namespace App\Repositories;
use App\IRepositories\INotificationTokenRepository;
use App\Models\NotificationToken;
use App\Models\DeviceGroup;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Throwable;
class NotificationTokenRepository implements INotificationTokenRepository
{


    public function saveUserToken($user_id, $token)
    {
        try{
            // verificar si el id usuario existe en la tabla de grupos(significa que ya tiene un grupo)
            $deviceGroupRegister = DeviceGroup::where('user_id', $user_id)->first();
            // si no existe crear un keyname y grupo con ese token(esto solo pasara una vez por usuario)
            if(is_null($deviceGroupRegister)) {
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
                //registramos el token
                NotificationToken::create([
                    'device_groups_id' => $deviceGroup->id,
                    'token' => $token,
                ]);
                // si no existia, regresamos el grupo que se acaba de crear
                return $deviceGroup;
            }
            //si existe hacer una petticion para agregar ese nuevo token
            else{
                //agregamos el toquen al gryupo
                    $addToken = Http::withHeaders([
                        'Authorization' => env('FCM_KEY'),
                        'project_id' => env('PROJECT_ID')
                    ])->acceptJson()->post('https://fcm.googleapis.com/fcm/notification',
                        [
                            "operation"=>"add",
                            "notification_key_name" => $deviceGroupRegister->notification_key_name,
                            "notification_key" => $deviceGroupRegister->notification_key,
                            "registration_ids" => [$token]
                        ]);
                    //guardamos el nuevo token el la BBDD
                    NotificationToken::create([
                        'device_groups_id' => $deviceGroupRegister->id,
                        'token' => $token,
                    ]);
                    // si se agrego un token a un grupo existente, regresamos el grupo existente
                    return $deviceGroupRegister;
            }
        }catch (Throwable $e){
            return $e;
        }
    }


    public function deleteUserToken($user_id, $token)
    {
      try{
          $deviceGroupRegister = DeviceGroup::where('user_id', $user_id)->first();
          $deleteToken = Http::withHeaders([
              'Authorization' => env('FCM_KEY'),
              'project_id' => env('PROJECT_ID')
          ])->acceptJson()->post('https://fcm.googleapis.com/fcm/notification',
              [
                  "operation"=>"remove",
                  "notification_key_name" => $deviceGroupRegister->notification_key_name,
                  "notification_key" => $deviceGroupRegister->notification_key,
                  "registration_ids" => [$token]
              ]);

          $notificationToke = NotificationToken::where('device_groups_id',$deviceGroupRegister->id)->where('token',$token)->first();
          $deleteToken = $notificationToke->delete();

          $checksToken = NotificationToken::where('device_groups_id',$deviceGroupRegister->id)->get();
          if($checksToken->count() <= 0){
              $deviceGroupRegister->delete();
          }
          return $deleteToken;

      }catch (Throwable $e){
          return $e;
      }
    }
}
