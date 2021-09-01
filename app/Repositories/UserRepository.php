<?php

namespace App\Repositories;
use App\Models\Box;
use App\Models\User;
use Cloudinary\Cloudinary;
use App\IRepositories\IUserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{

    public function create($data)
    {
        $foto = null;
        $user = null;
        try{
            global $foto;
            global $user;

            DB::beginTransaction();
            if(!is_null($data->file('file'))){
                $foto = cloudinary()->upload($data->file('file')->getRealPath());
            }
            $data['password'] = $this->hashPassword($data->password);
            $user = User::create([
                'name'=>$data->nombre,
                'last_name1'=>$data->apellidoPat,
                'last_name2'=>$data->apellidoMat,
                'job'=>$data->puesto,
                'date_of_birth'=>$data->fecha,
                'email'=>$data->correo,
                'photo'=>$foto == null ? $foto : $foto->getSecurePath(),
                'photoId'=>$foto == null ? $foto : $foto->getPublicId(),
                'password'=>$data->password,
                'user_type_id'=>$data->userTypeId,
            ]);
            Box::create([
                'amount'=>0,
                'user_id'=>$user->id,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            cloudinary()->destroy($foto->getPublicId());
        }
        return $user;

    }
    public function show($id){
        return User::where('id',$id)->with('box')->first();
    }
    public function update($data, $id){
        $foto = null;
        $user = null;
        try{
            global $foto;
            global $user;

            DB::beginTransaction();
            $user =  User::find($id);
            //si el request trae data entonces hay que subir a foto y guardarlo
            if(!is_null($data->file('file'))){
                $foto = cloudinary()->upload($data->file('file')->getRealPath());
                $user->photo =$foto->getSecurePath();
                $user->photoId =$foto->getPublicId();
            }
            //actualizando los datos
            $user->name = $data->name;
            $user->last_name1 = $data->last_name1;
            $user->last_name2 = $data->last_name2;
            $user->job = $data->job ;
            $user->date_of_birth = $data->date_of_birth;
            $user->email = $data->email;
            $user->user_type_id = $data->user_type_id;
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            if(!is_null($foto)){
                cloudinary()->destroy($foto->getPublicId());
            }
        }

        return $user;
    }
    public function delete($id){

    }

    public function hashPassword($password): string
    {
        return Hash::make($password);
    }

    public function all(){
        return User::with('box')->get();
    }

    public function getCoordinadores()
    {
        return User::where('user_type_id',2)->orWhere('user_type_id',3)->with('box')->get();
    }

    public function onlyUsers(){
        return User::paginate(10);
    }


    public function getBoss()
    {
        return User::where('user_type_id',1)->orWhere('user_type_id',2)->orWhere('user_type_id',3)->get();
    }

    public function getUserXId($id)
    {
        return User::find($id);
    }

    public function changePasswordFromUser($id, $password)
    {
        $user = User::find($id);
        $user->password = $this->hashPassword($password);
        $user->save();
        return $user;
    }
}
