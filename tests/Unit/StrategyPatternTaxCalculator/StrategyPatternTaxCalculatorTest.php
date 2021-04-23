<?php

namespace Tests\Unit\StrategyPatternTaxCalculator;

use PHPUnit\Framework\TestCase;

use App\Domains\Budget\Budget;
use App\Domains\StrategyPatternTaxCalculator\TaxCalculator;
use App\Domains\StrategyPatternTaxCalculator\Taxes\IcmsTax;
use App\Domains\StrategyPatternTaxCalculator\Taxes\IssTax;
use App\Domains\StrategyPatternTaxCalculator\Taxes\InssTax;
use App\Domains\StrategyPatternTaxCalculator\Taxes\FgtsTax;

class StrategyPatternTaxCalculatorTest extends TestCase
{
    /**
     * Test Iss Tax.// vendor\bin\phpunit
     *
     * @return void
     */
    public function testIssTax()
    {
    	foreach ($this->testCasesIssTaxData() as $testCase => $data) {
	    	$taxResult = (new TaxCalculator())->calculate(
	    		new Budget($data['input']['value']), 
	    		$data['input']['class']
	    	);

            $this->assertArrayHasKey('tax', $taxResult);
	        $this->assertEquals($taxResult['tax'], $data['output']);
    	}

    }

    private function testCasesIssTaxData()
    {
    	return [
    		'taxIss' => [
    			'input' => [
                    'class' => new IssTax(),
    				'value' => 10
    			],
    			'output' => 1
    		],
    		'taxInss' => [
    			'input' => [
                    'class' => new InssTax(),
    				'value' => 25
    			],
    			'output' => 3
    		],
            'taxIcms' => [
                'input' => [
                    'class' => new IcmsTax(),
                    'value' => 25
                ],
                'output' => 1.5
            ],
            'taxFgts' => [
                'input' => [
                    'class' => new FgtsTax(),
                    'value' => 10
                ],
                'output' => 1.5
            ],
    	];
    }
}
