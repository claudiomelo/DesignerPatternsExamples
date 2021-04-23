<?php

namespace App\Domains\Budget;

/**
 * Responsable for Budget
 */
class Budget
{
	public int $amount;
	public float $value;

	public function __construct(float $value, int $amount = 1)
	{
		$this->amount = $amount;
		$this->value = $value;
	}
}