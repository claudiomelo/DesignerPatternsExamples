<?php

namespace App\Domains\StrategyPatternTaxCalculator\Taxes;

use App\Interfaces\TaxInterface;

/**
 * Responsable to calculate the iss tax
 */
class IssTax implements TaxInterface
{
	private float $taxPercet = 0.1; //10%

	public function calculate(float $value): float
	{
		return $value*$this->taxPercet;
	}
}