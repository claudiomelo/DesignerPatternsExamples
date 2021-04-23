<?php

namespace App\Domains\StrategyPatternTaxCalculator\Taxes;

use App\Interfaces\TaxInterface;
use App\Domains\Budget\Budget;

/**
 * Responsable to calculate the inss tax
 */
class InssTax implements TaxInterface
{
	private float $taxPercet = 0.12; //10%

	public function calculate(Budget $budget): float
	{
		return $budget->value*$this->taxPercet;
	}
}