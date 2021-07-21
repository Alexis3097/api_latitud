<?php
namespace App\Enums;
use MyCLabs\Enum\Enum;
final class ResponseMessages extends Enum
{
    private const GET_RESOURCES_VOID = 'Registros no encontrados';
    private const GET_RESOURCES_FAILED_500 = 'Error al traer los datos: ';
    private const STORE_FAILED_400 = 'Registro no guardado';
    private const STORE_FAILED_500 = 'Error al guardar los datos: ';
    private const GET_RESOURCE_VOID = 'Registro no encontrado';
    private const UPDATE_SUCCESS = 'Registro actualizado';
    private const UPDATE_FAILED_400 = 'Registro no actualizado';
    private const UPDATE_FAILED_500 = 'Error al actualizar los datos: ';
    private const DESTROY_SUCCESS = 'Registro eliminado';
    private const DESTROY_FAILED_400 = 'Registro no eliminado';
    private const DESTROY_FAILED_500 = 'Error al eliminar los datos: ';
    private const POSTSUCCESSFUL = 'Se guardo el registro';


}
