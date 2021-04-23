<?php

namespace Tests\Feature\StrategyPatternTaxCalculatorController\Functions;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CalculateIssControllerFunctionTest extends TestCase
{
    /**
     * Test by get route.
     *
     * @return void
     */
    public function testCalculateIssTest()
    {
        foreach ($this->testCasesData() as $tesCase => $data) {
            $rota = 'strategyPattern/calculateIssTax?'.http_build_query($data['input']);
            $response = $this->call('GET', $rota);

            $response->assertJsonFragment(
                $data['output']['data']
            );

            $response->assertStatus($data['output']['status']);
        }
    }

    /**
     * Test by post route.
     *
     * @return void
     */
    public function testCalculateIssPostTest()
    {
        foreach ($this->testCasesData() as $tesCase => $data) {
            $response = $this->call(
                'POST',
                'strategyPattern/calculateIssTax',
                $data['input']
            );

            $response->assertJsonFragment(
                $data['output']['data']
            );

            $response->assertStatus($data['output']['status']);
        }
    }

    private function testCasesData()
    {
        return [
            'testValueInteger' => [
                'input' => ['value' => 5],
                'output' => [
                    'data' => ['tax' => 0.5],
                    'status' => 200
                ]
            ],
            'testErrorValueRequired' => [
                'input' => [],
                'output' => [
                    'data' => [
                        'value' => ['The value field is required.']
                    ],
                    'status' => 400
                ]
            ],
            'testValueFloat' => [
                'input' => ['value' => 5.5],
                'output' => [
                    'data' => [
                        'value' => ['The value must be an integer.']
                    ],
                    'status' => 400
                ]
            ],
            'testValueString' => [
                'input' => ['value' => 'teste error'],
                'output' => [
                    'data' => [
                        'value' => ['The value must be an integer.']
                    ],
                    'status' => 400
                ]
            ],
        ];
    }
}
