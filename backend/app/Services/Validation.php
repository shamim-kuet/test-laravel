<?php
namespace App\Services;
use Illuminate\Support\Collection;
use Validator;
use Illuminate\Http\Request;

class Validation
{


	public function __construct(){

	}

	public function storeValidation($error)
    {
		foreach($error->toArray() as $err){
            $errmsg[] = $err;
         }
         //$array = array_reduce($errmsg, 'array_merge', array());
         $array = array_map('current', $errmsg);
         return $array;
    }
}
