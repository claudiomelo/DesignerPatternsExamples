<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StrategyPatternTaxCalculatorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     * Adiciona o parâmetro id aos dados que serão validados
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'id' => (int) $this->route('fonte'),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'id' => 'required|integer|min:1|exists:fontes,id',
            // 'nome' => 'sometimes|string|filled',
            // 'id_captura' => 'sometimes|integer|min:1|exists:App\Models\Captura,id',
            // 'ativo' => 'sometimes|boolean',
            // 'param_payload' => 'sometimes|json|filled'
        ];
    }
}
