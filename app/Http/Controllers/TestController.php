<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTest;
use App\Http\Resources\TestResource;
use App\IRepositories\ITestRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

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
            return TestResource::collection($tests);
        }catch(Throwable $e){
            Log::info('Error al traer los datos: '.$e);
            return response()->json(['get'=>false],500);
        }
    }

    public function store(StoreTest $request)
    {
        try{
            $test = $this->ITestRepository->create($request->all());
            return new TestResource($test);
        }catch(Throwable $e){
            Log::info('Error al guardar los datos: '.$e);
            return response()->json(['store'=>false],500);
        }
    }

    public function show($id)
    {
        try{
            $test = $this->ITestRepository->show($id);
            if(is_null($test)){
                return response()->json(['messages'=>'Registro no encontrado']);
            }
            else{
                return new TestResource($test);
            }
        }catch(Throwable $e){
            Log::info('Error al traer los datos: '.$e);
            return response()->json(['get'=>false],500);
        }
    }


    public function update(Request $request, $id)
    {
        try{
            $test = $this->ITestRepository->update($request->all(), $id);
            if($test){
                return response()->json(['messages'=>'Registro actualizado']);
            }
            else{
                return response()->json(['messages'=>'Registro no actualizado']);
            }
        }catch(Throwable $e){
            Log::info('Error al actualizar los datos: '.$e);
            return response()->json(['update'=>false],500);

        }
    }

    public function destroy($id)
    {
        try{
            $test = $this->ITestRepository->delete($id);
            if($test){
                return response()->json(['messages'=>'Registro eliminado']);
            }
            else{
                return response()->json(['messages'=>'Registro no eliminado']);
            }
        }catch(Throwable $e){
            Log::info('Error al eliminar los datos: '.$e);
            return response()->json(['destroy'=>false],500);
        }
    }

}
