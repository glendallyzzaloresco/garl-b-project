<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculateController extends Controller
{
    public function add () {
        $n1 = 5;   //logic
        $n2 = 3;     //logic
        $sum = $n1 + $n2; //logic
        return "Sum is: ".$sum; //logic
    }
    public function subtract () {
        $n1 = 5;   //logic
        $n2 = 3;    //logic
        $sub = $n1 - $n2; //logic
        return "Difference is: ".$sub; //logic
    }
    public function multiply () {
        $n1 = 5;   //logic
        $n2 = 3;     //logic
        $mul = $n1 * $n2; //logic
        return "Product is: ".$mul; //logic
    }
    public function divide () {
        $n1 = 5;   //logic
        $n2 = 3;     //logic
        $div = $n1 / $n2; //logic
        return "Quotient is: ".$div; //logic
    }
    public function modulo () {
        $n1 = 5;   //logic
        $n2 = 3;     //logic
        $mod = $n1 % $n2; //logic
        return "Remainder is: ".$mod; //logic
    }
    

    

}