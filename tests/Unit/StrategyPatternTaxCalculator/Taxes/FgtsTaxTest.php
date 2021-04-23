<?php

namespace Tests\Unit\StrategyPatternTaxCalculator\Taxes;

use PHPUnit\Framework\TestCase;

use App\Domains\Budget\Budget;
use App\Domains\StrategyPatternTaxCalculator\TaxCalculator;
use App\Domains\StrategyPatternTaxCalculator\Taxes\FgtsTax;

class FgtsTaxTest extends TestCase
{
    /**
     * Test Iss Tax.// vendor\bin\phpunit
     *
     * @return void
     */
    public function testFgtsTax()
    {
    	foreach ($this->testCasesFgtsTaxData() as $testCase => $data) {
	    	$fgtsTax = (new TaxCalculator())->calculate(
	    		new Budget($data['input']['value']), 
	    		new FgtsTax()
	    	);

	    	$this->assertArrayHasKey('tax', $fgtsTax);
	        $this->assertEquals($fgtsTax['tax'], $data['output']);
    	}

    }

    private function testCasesFgtsTaxData()
    {
    	return [
    		'taxOk1' => [
    			'input' => [
    				'value' => 10
    			],
    			'output' => 1.5
    		],
    		'taxOk2' => [
    			'input' => [
    				'value' => 25
    			],
    			'output' => 3.75
    		],
    	];
    }
}
