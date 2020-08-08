<?php

namespace App\Http\Requests;

use App\Custom\BaseRequest;

class UserRequest extends BaseRequest
{
    public function rules()
    {
        return array_replace_recursive(parent::rules(), ['password' => 'confirmed']);
    }
}
