<?php

namespace App\Http\Requests\Alert;


class UpdateRequest extends BaseRequest
{
    protected function getMandatoryRule(): string
    {
        return 'filled';
    }
}
