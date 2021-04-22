<?php

namespace App\Interfaces;

interface TaxCalculatorInterface
{
    public function calculate(float $value, TaxInterface $tax): array;
}
