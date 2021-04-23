<?php

namespace Tests\Unit\StrategyPatternTaxCalculator\Taxes;

use PHPUnit\Framework\TestCase;

use App\Http\Controllers\StrategyPatternTaxCalculatorController;
use App\Http\Requests\StrategyPatternTaxCalculatorRequest;
use App\Domains\Budget\Budget;
use App\Domains\StrategyPatternTaxCalculator\TaxCalculator;
use App\Domains\StrategyPatternTaxCalculator\Taxes\IssTax;

class IssTaxTest extends TestCase
{
    /**
     * Test Iss Tax.// vendor\bin\phpunit
     *
     * @return void
     */
    public function testIssTax()
    {
    	foreach ($this->testCasesIssTaxData() as $testCase => $data) {
	    	$issTax = (new TaxCalculator())->calculate(
	    		new Budget($data['input']['value']), 
	    		new IssTax()
	    	);

            $this->assertArrayHasKey('tax', $issTax);
	        $this->assertEquals($issTax['tax'], $data['output']);
    	}

    }

    private function testCasesIssTaxData()
    {
    	return [
    		'taxOk1' => [
    			'input' => [
    				'value' => 10
    			],
    			'output' => 1
    		],
    		'taxOk2' => [
    			'input' => [
    				'value' => 25
    			],
    			'output' => 2.5
    		],
    	];
    }
}
