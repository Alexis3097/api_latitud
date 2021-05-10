<?php
namespace App\Enums;
use MyCLabs\Enum\Enum;
final class httpMessages extends Enum
{
    private const GET_RESOURCES_VOID = 'Registros no encontrados';
    private const UPDATE_FAILED = 'edit';
    private const UPDATE_SUCCESS = 'edit';
}
