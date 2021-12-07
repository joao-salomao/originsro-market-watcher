<?php

namespace App\Http\Requests\Alert;


class CreateRequest extends BaseRequest
{
    protected function getMandatoryRule(): string
    {
        return 'required';
    }
}
