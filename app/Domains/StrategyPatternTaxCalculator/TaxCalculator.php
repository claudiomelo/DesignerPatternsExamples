<?php

namespace App\Domains\StrategyPatternTaxCalculator;

use App\Interfaces\TaxCalculatorInterface;
use App\Interfaces\TaxInterface;

/**
 * Responsable to calculate tax
 */
class TaxCalculator implements TaxCalculatorInterface
{
	public function calculate(float $value, TaxInterface $tax): array
	{
		$taxValue = $tax->calculate($value);

		return ['tax' => $taxValue];
	}
}