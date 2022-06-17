<?php

namespace shop\helpers;

class WeightHelper
{
    public static function format($weight): string
    {
        return round($weight, 1) . ' Кг';
    }
}