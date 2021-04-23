<?php

namespace App\Interfaces;

use App\Domains\Budget\Budget;

interface TaxInterface
{
    public function calculate(Budget $budget): float;
}
