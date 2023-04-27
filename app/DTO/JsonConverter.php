<?php

namespace App\DTO;

interface JsonConverter
{
    public static function convert(array $data): Convertable;
}
