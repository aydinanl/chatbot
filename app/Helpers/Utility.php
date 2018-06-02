<?php
/**
 * Created by PhpStorm.
 * User: aydinanl
 * Date: 23.04.2018
 * Time: 22:24
 */

namespace App\Helpers;

use Illuminate\Contracts\Validation\Validator;

class Utility
{
    public static function formatErrors(Validator $validator)
    {
        return response()->json(['error' => ['message' => $validator->errors()->first(), 'status' => 400]],400);
    }

    public static function formatErrorsArray(Validator $validator)
    {
        return ['error' => ['message' => $validator->errors()->first(), 'status' => 400]];
    }

    public static function validatorMessages(): array
    {
        $messages = [
            'required' => ':Attribute alanı zorunludur.',
            'unique' => 'Girilen :attribute değeri daha önceden alınmış.',
            'min' => 'Girilen :attribute değeri en az :min karakterli olmalıdır.',
            'max' => 'Girilen :attribute değeri en fazla :max karakterli olmalıdır.',
            'numeric' => 'Girilen :attribute değeri rakam olmalıdır.',
            'exists' => 'Girilen :attribute bulunmamaktadır.'
        ];
        return $messages;
    }
}