<?php
namespace App\Helpers;
use App\Helpers\FormMapper\FormObjectRepresentation;
class Generator
{
    public static function generateRepresentation(array $dataFormSubmitted, string $classRepresentation): FormObjectRepresentationInterface
    {
        return new $classRepresentation($dataFormSubmitted);
    }
}