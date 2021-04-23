<?php

namespace App\Interfaces;

use App\Domains\Budget\Budget;

interface TaxCalculatorInterface
{
    public function calculate(Budget $budget, TaxInterface $tax): array;
}
