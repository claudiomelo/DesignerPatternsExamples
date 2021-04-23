<?php

namespace App\Domains\StrategyPatternTaxCalculator;

use App\Domains\Budget\Budget;
use App\Interfaces\TaxCalculatorInterface;
use App\Interfaces\TaxInterface;

/**
 * Responsable to calculate tax
 */
class TaxCalculator implements TaxCalculatorInterface
{
	public function calculate(Budget $budget, TaxInterface $tax): array
	{
		$taxValue = $tax->calculate($budget);

		return ['tax' => $taxValue];
	}
}