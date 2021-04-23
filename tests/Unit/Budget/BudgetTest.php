<?php

namespace Tests\Unit\StrategyPatternTaxCalculator;

use PHPUnit\Framework\TestCase;
use App\Domains\Budget\Budget;

class BudgetTest extends TestCase
{
    /**
     * Test budget.// vendor\bin\phpunit
     *
     * @return void
     */
    public function testBudget()
    {
    	foreach ($this->testCasesBudgetData() as $testCase => $data) {
	    	$budget = new Budget($data['input']['value'], $data['input']['amount']);

            $this->assertEquals($data['output']['value'], $budget->value);
	        $this->assertEquals($data['output']['amount'], $budget->amount);
    	}

    }

    private function testCasesBudgetData()
    {
    	return [
    		'testOnlyIntegers' => [
    			'input' => [
                    'amount' => 10,
    				'value' => 10
    			],
    			'output' => [
                    'amount' => 10,
                    'value' => 10
                ],
    		],
            'testFloats' => [
                'input' => [
                    'amount' => 10,
                    'value' => 10.5
                ],
                'output' => [
                    'amount' => 10,
                    'value' => 10.5
                ],
            ],
    	];
    }
}
