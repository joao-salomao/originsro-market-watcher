<?php

namespace App\Http\Requests\Alert;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $mandatoryRule = $this->getMandatoryRule();
        return [
            'max_price' => "$mandatoryRule|numeric",
            'item_id' => "$mandatoryRule|exists:items,id"
        ];
    }

    abstract protected function getMandatoryRule(): string;
}
