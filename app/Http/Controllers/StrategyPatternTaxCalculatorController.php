<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Responses\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\StrategyPatternTaxCalculatorRequest;
use App\Domains\Budget\Budget;
use App\Domains\StrategyPatternTaxCalculator\TaxCalculator;
use App\Domains\StrategyPatternTaxCalculator\Taxes\IcmsTax;
use App\Domains\StrategyPatternTaxCalculator\Taxes\IssTax;
use App\Domains\StrategyPatternTaxCalculator\Taxes\InssTax;
use App\Domains\StrategyPatternTaxCalculator\Taxes\FgtsTax;

ini_set('display_errors', 1);
error_reporting(E_ALL);

class StrategyPatternTaxCalculatorController extends Controller
{
	/**
	 * calculate the iss tax
	*/
    public function calculateIssTax(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'value' => 'required|integer',
            // 'value3' => 'required|integer'
        ]);

    	if ($validator->fails())
        {
			return Response::error(
	    		$validator->errors()->toArray(),
	    		400,
	    		$this->startTime
	    	);       
        }

		// echo "<pre>lol";
		// print_r($validate);
		// exit;

    	return $this->callTaxCalculation(new Budget($request->value), new IssTax());
    }

    /**
	 * calculate the icms tax
	*/
    public function calculateIcmsTax(StrategyPatternTaxCalculatorRequest $request)
    {
    	return $this->callTaxCalculation(new Budget($request->value), new IcmsTax());
    }

    /**
	 * calculate the inss tax
	*/
    public function calculateInssTax(StrategyPatternTaxCalculatorRequest $request)
    {
    	return $this->callTaxCalculation(new Budget($request->value), new InssTax());
    }

    /**
	 * calculate the FGTS tax
	*/
    public function calculateFgtsTax(StrategyPatternTaxCalculatorRequest $request)
    {
    	return $this->callTaxCalculation(new Budget($request->value), new FgtsTax());
    }

    /**
	 * calculate all tax
	*/
    public function calculateAllTax(StrategyPatternTaxCalculatorRequest $request)
    {
    	try {
	    	$totalTax = (new TaxCalculator())->calculate(new Budget($request->value), new IssTax())['tax'];
	    	$totalTax += (new TaxCalculator())->calculate(new Budget($request->value), new IcmsTax())['tax'];
	    	$totalTax += (new TaxCalculator())->calculate(new Budget($request->value), new InssTax())['tax'];
	    	$totalTax += (new TaxCalculator())->calculate(new Budget($request->value), new FgtsTax())['tax'];

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
    private function callTaxCalculation(Budget $budget, $tax)
    {
    	try {
	    	return Response::success(
	    		(new TaxCalculator())->calculate($budget, $tax),
	    		200,
	    		$this->startTime
	    	);
    	} catch (\Exception $e) {
    		return Response::exception($e);
    	} 
    }
}
