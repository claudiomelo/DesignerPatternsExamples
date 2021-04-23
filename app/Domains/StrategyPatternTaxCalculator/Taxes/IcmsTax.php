<?php

namespace App\Domains\StrategyPatternTaxCalculator\Taxes;

use App\Interfaces\TaxInterface;
use App\Domains\Budget\Budget;

/**
 * Responsable to calculate the icms tax
 */
class IcmsTax implements TaxInterface
{
	private float $taxPercet = 0.06; //6%

	public function calculate(Budget $budget): float
	{
		return $budget->value*$this->taxPercet;
	}
}