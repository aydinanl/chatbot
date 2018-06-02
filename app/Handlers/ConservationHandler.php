<?php
namespace App\Handlers;

use App\Models\Intents;

class ConservationHandler
{
    // Finds {} and replace as variables value.
    public static function changeOutputWithVariable(Intents $intent): array
    {
        $answer = collect($intent);

        $str = $answer['output'];
        $values = $answer['variable_values'];
        $value_names = $answer['variable_names'];
        $value_c = 0;
        foreach ($value_names as $value){
            $src = '{' . $value . '}';
            $str = str_replace($src, $values[$value_c], $str);
            $value_c++;
        }
        return [
            'answer' => $str
        ];
    }

    // Finds {} and replace as variables value due to response value.
    public static function changeOutputWithResponseVariable(Intents $intent, $response): array
    {
        $answer = collect($intent);

        //Şuan hava {response.main.temp} derece.
        $str = $answer['output'];

        $first = strpos($str, '{');
        $last = strpos($str, '}');
        $str_len = $last - $first;

        $res_str = substr($str, $first+1, $str_len-1);
        $res_str_nodes = explode('.',$res_str);

        $res_str_build = self::buildResponseStrValue($response,$res_str_nodes);

        $first_str = substr($str, 0,$first);
        $last_str = substr($str, $last+1);
        $str = $first_str . $res_str_build . $last_str;

        return [
            'answer' => $str
        ];
    }

    public static function buildResponseStrValue($response,$nodes): string
    {
        $res = collect($response);

        for ($i = 1;$i<count($nodes);$i++){
            $res = collect($res[$nodes[$i]]);
        }
        return $res[0];
    }
}