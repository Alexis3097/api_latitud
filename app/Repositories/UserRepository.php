<?php

namespace App\Repositories;
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
            $foto = cloudinary()->upload($data->file('file')->getRealPath());
            $data['password'] = $this->hashPassword($data->password);
            $user = User::create([
                'name'=>$data->nombre,
                'last_name1'=>$data->apellidoPat,
                'last_name2'=>$data->apellidoMat,
                'job'=>$data->puesto,
                'date_of_birth'=>$data->fecha,
                'email'=>$data->correo,
                'photo'=>$foto->getSecurePath(),
                'photoId'=>$foto->getPublicId(),
                'password'=>$data->password,
                'user_type_id'=>$data->userTypeId,
            ]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            cloudinary()->destroy($foto->getPublicId());
            $user = null;
        }
        return $user;

    }
    public function show($id){

    }
    public function update($data, $id){

    }
    public function delete($id){
        //elimina uno con el id
        cloudinary()->destroy('vprj55y9kdos3mbz1n4h');
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
        return User::where('user_type_id',2)->with('box')->get();
    }

}
