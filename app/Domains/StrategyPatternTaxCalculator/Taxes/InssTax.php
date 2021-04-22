<?php

namespace App\Domains\StrategyPatternTaxCalculator\Taxes;

use App\Interfaces\TaxInterface;

/**
 * Responsable to calculate the inss tax
 */
class InssTax implements TaxInterface
{
	private float $taxPercet = 0.12; //10%

	public function calculate(float $value): float
	{
		return $value*$this->taxPercet;
	}
}