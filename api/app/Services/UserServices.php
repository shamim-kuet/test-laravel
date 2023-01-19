<?php
namespace App\Services;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
class UserServices
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
					$user = new User();

					$user->name = $req->name;
					$user->email = $req->email;
					$user->phone = $req->phone;
					$user->username = $req->username;
					$user->status = $req->status;

					if($user->save()){
						return response()->json(['status' => 'Success','message' => "Successfully inserted"], Response::HTTP_CREATED);
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
				return response()->json(['status' => 'error','message' => "Please enter valid email"]);
			}
	}


	public function update(UserUpdateRequest $req, $id){
		if (request()->has('email')) {					////////// Check Request validity
			try{
				$user = User::findOrFail($id);
				$user->name = $req->name;
				$user->email = $req->email;
				$user->phone = $req->phone;
				$user->username = $req->username;
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
			return response()->json(['status' => 'error','message' => "Please enter valid email"]);
		}
	}
}
