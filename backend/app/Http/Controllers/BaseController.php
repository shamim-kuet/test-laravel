<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{

    public function __construct()
    {
		
        $this->middleware(function ($request, $next) {	
					
            if (!session()->has('user_id')) {				
				return redirect('/');
			}
            return $next($request);
        });
		
    }
}
