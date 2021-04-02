<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BmiController extends Controller
{
    public function index(Request $request){
        $this->validate($request, [
            'height' => ['numeric','required'],
            'weight' => ['numeric','required']
        ],
            $messages = [
                'numeric' => 'The input must be a number.'
            ]
        );

        $height = $request->get('height');
        $weight = $request->get('weight');

        $bmi=round($weight / pow(($height / 100), 2), 1);

        switch($bmi){
            case ($bmi >= 25):
                $label='overweight';
                break;
            case ($bmi <= 18.4):
                $label='underweight';
                break;
            default:
                $label='normal';
        }

        return response()->json(['bmi' => $bmi, 'label' => $label]);
    }

}
