<?php

namespace App\Domains\StrategyPatternTaxCalculator\Taxes;

use App\Interfaces\TaxInterface;

/**
 * Responsável calcular o valor de um imposto
 */
class FgtsTax implements TaxInterface
{
	private float $taxPercet = 0.15; //10%

	public function calculate(float $value): float
	{
		return $value*$this->taxPercet;
	}
}