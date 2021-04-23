<?php

namespace App\Domains\StrategyPatternTaxCalculator\Taxes;

use App\Interfaces\TaxInterface;
use App\Domains\Budget\Budget;

/**
 * Responsável calcular o valor de um imposto
 */
class FgtsTax implements TaxInterface
{
	private float $taxPercet = 0.15; //10%

	public function calculate(Budget $budget): float
	{
		return $budget->value*$this->taxPercet;
	}
}