<?php

namespace Tests\Unit\StrategyPatternTaxCalculator\Taxes;

use PHPUnit\Framework\TestCase;

use App\Domains\Budget\Budget;
use App\Domains\StrategyPatternTaxCalculator\TaxCalculator;
use App\Domains\StrategyPatternTaxCalculator\Taxes\IcmsTax;

class IcmsTaxTest extends TestCase
{
    /**
     * Test Iss Tax.// vendor\bin\phpunit
     *
     * @return void
     */
    public function testIcmsTax()
    {
    	foreach ($this->testCasesIcmsTaxData() as $testCase => $data) {
	    	$icmsTax = (new TaxCalculator())->calculate(
	    		new Budget($data['input']['value']), 
	    		new IcmsTax()
	    	);

            $this->assertArrayHasKey('tax', $icmsTax);
	        $this->assertEquals($icmsTax['tax'], $data['output']);
    	}

    }

    private function testCasesIcmsTaxData()
    {
    	return [
    		'taxOk1' => [
    			'input' => [
    				'value' => 10
    			],
    			'output' => 0.6
    		],
    		'taxOk2' => [
    			'input' => [
    				'value' => 25
    			],
    			'output' => 1.5
    		],
    	];
    }
}
