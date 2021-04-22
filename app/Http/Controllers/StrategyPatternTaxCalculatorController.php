<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Responses\Response;
use App\Http\Requests\StrategyPatternTaxCalculatorRequest;
use App\Domains\StrategyPatternTaxCalculator\TaxCalculator;
use App\Domains\StrategyPatternTaxCalculator\Taxes\IcmsTax;
use App\Domains\StrategyPatternTaxCalculator\Taxes\IssTax;
use App\Domains\StrategyPatternTaxCalculator\Taxes\InssTax;
use App\Domains\StrategyPatternTaxCalculator\Taxes\FgtsTax;

class StrategyPatternTaxCalculatorController extends Controller
{
	/**
	 * calculate the iss tax
	*/
    public function calculateIssTax(StrategyPatternTaxCalculatorRequest $request)
    {
    	return $this->callTaxCalculation($request->value, new IssTax());
    }

    /**
	 * calculate the icms tax
	*/
    public function calculateIcmsTax(StrategyPatternTaxCalculatorRequest $request)
    {
    	return $this->callTaxCalculation($request->value, new IcmsTax());
    }

    /**
	 * calculate the inss tax
	*/
    public function calculateInssTax(StrategyPatternTaxCalculatorRequest $request)
    {
    	return $this->callTaxCalculation($request->value, new InssTax());
    }

    /**
	 * calculate the FGTS tax
	*/
    public function calculateFgtsTax(StrategyPatternTaxCalculatorRequest $request)
    {
    	print_r( (new TaxCalculator())->calculate($request->value, new FgtsTax()));
    	// exit;
    	return $this->callTaxCalculation($request->value, new FgtsTax());
    }

    /**
	 * calculate all tax
	*/
    public function calculateAllTax(StrategyPatternTaxCalculatorRequest $request)
    {
    	try {
	    	$totalTax = (new TaxCalculator())->calculate($request->value, new IssTax())['tax'];
	    	$totalTax += (new TaxCalculator())->calculate($request->value, new IcmsTax())['tax'];
	    	$totalTax += (new TaxCalculator())->calculate($request->value, new InssTax())['tax'];
	    	$totalTax += (new TaxCalculator())->calculate($request->value, new FgtsTax())['tax'];

	    	return Response::success(
	    		['tax' => $totalTax],
	    		200,
	    		$this->startTime
	    	);
    	} catch (Exception $e) {
    		return Response::exception($e);
    	}


    }

    /**
	 * call tax calculator to calculate the tax
	*/
    private function callTaxCalculation(float $value, $tax)
    {
    	try {
	    	return Response::success(
	    		(new TaxCalculator())->calculate($value, $tax),
	    		200,
	    		$this->startTime
	    	);
    	} catch (\Exception $e) {
    		return Response::exception($e);
    	} 
    }
}
