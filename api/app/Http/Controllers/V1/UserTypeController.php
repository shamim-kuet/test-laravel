<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserTypes;

class UserTypeController extends Controller
{
    public function index(UserTypes $userTypes){		
		return $userTypes->getList();
	}
	
	public function store(UserTypes $userTypes, Request $req){	
		// dd($req->all());
		return $userTypes->store($req);
	}
	
	public function update(UserTypes $userTypes, Request $req, $id){	
		return $userTypes->update($req, $id);
	}
}
