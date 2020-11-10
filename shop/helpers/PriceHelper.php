<?php
namespace shop\helpers;
class PriceHelper
{
    public static function format($price): string
    {
        return number_format($price, 0, '.', ' ')."&nbsp&#8381";
    }

    public static function formatModification($price): string
    {
        return number_format($price, 0, '.', ' ');
    }

    public static function formatBackend($price): string
    {
        return number_format($price, 0, '.', ' ');
    }
}