<?php

namespace App\Domains\StrategyPatternTaxCalculator\Taxes;

use App\Interfaces\TaxInterface;

/**
 * Responsable to calculate the icms tax
 */
class IcmsTax implements TaxInterface
{
	private float $taxPercet = 0.06; //6%

	public function calculate(float $value): float
	{
		return $value*$this->taxPercet;
	}
}