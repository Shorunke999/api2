<?php

namespace App\Exceptions;

use Exception;

class modelException extends Exception
{
    public function report(){
       // dd('report method');
    }//the logic that report error
    public function render(){
        return response()->json([
            'error'=> $this->getMessage(),
        ],422);
    }//our http respomse error
}
