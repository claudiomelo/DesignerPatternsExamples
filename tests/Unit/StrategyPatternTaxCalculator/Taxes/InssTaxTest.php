<?php

namespace Tests\Unit\StrategyPatternTaxCalculator\Taxes;

use PHPUnit\Framework\TestCase;

use App\Domains\Budget\Budget;
use App\Domains\StrategyPatternTaxCalculator\TaxCalculator;
use App\Domains\StrategyPatternTaxCalculator\Taxes\InssTax;

class InssTaxTest extends TestCase
{
    /**
     * Test Iss Tax.// vendor\bin\phpunit
     *
     * @return void
     */
    public function testInssTax()
    {
    	foreach ($this->testCasesInssTaxData() as $testCase => $data) {
	    	$inssTax = (new TaxCalculator())->calculate(
	    		new Budget($data['input']['value']), 
	    		new InssTax()
	    	);

            $this->assertArrayHasKey('tax', $inssTax);
	        $this->assertEquals($inssTax['tax'], $data['output']);
    	}

    }

    private function testCasesInssTaxData()
    {
    	return [
    		'taxOk1' => [
    			'input' => [
    				'value' => 10
    			],
    			'output' => 1.2
    		],
    		'taxOk2' => [
    			'input' => [
    				'value' => 25
    			],
    			'output' => 3
    		],
    	];
    }
}
