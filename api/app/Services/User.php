<?php
namespace App\Services;
use Illuminate\Support\Collection;
use Validator;
use Illuminate\Http\Request;
use App\Models\UserType;

class UserTypes
{

	
	public function __construct(){
		
	}	
	
	public function getList()
    {		
		return User::all();
    }
	
	public function store($req){			
			if (request()->has('email')) {					////////// Check Request validity
				try{
					$user = new UserType();
					
					$user->name = $req->name;
					$user->company_id = $req->company_id;
					$user->status = $req->status;
					
					if($user->save()){
						return response()->json(['status' => 'Success','message' => "Successfully inserted"]);
					}
					else{
						return response()->json(['status' => 'Failed','message' => "Insert Failed"]);
					}			
				}
				catch(\Exception $e){
					return response()->json(['status' => 'error','message' => $e->getMessage()]);
				}
			}
			else{
				return response()->json(['status' => 'error','message' => "Please enter valid id"]);
			}		
	}
	
	
	public function update($req, $id){	
		if (request()->has('email')) {					////////// Check Request validity
			try{
				$user = UserType::findOrFail($id);					
				$user->name = $req->name;
				$user->company_id = $req->company_id;
				$user->status = $req->status;
				
				if($user->save()){
					return response()->json(['status' => 'Success','message' => "Successfully updated"]);
				}
				else{
					return response()->json(['status' => 'Failed','message' => "Update Failed"]);
				}			
			}
			catch(\Exception $e){
				return response()->json(['status' => 'error','message' => $e->getMessage()]);
			}
		}
		else{
			return response()->json(['status' => 'error','message' => "Please enter valid information"]);
		}		
	}
}