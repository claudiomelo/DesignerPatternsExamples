<?php

namespace App\Interfaces;

interface TaxInterface
{
    public function calculate(float $value): float;
}
