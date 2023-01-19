<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\Login\LoginService;
use App\Services\HomeService;
use App\View\Components\FlashMessages;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

	private $loginService;

	private $homeService;

	use FlashMessages;

    public function __construct(LoginService $loginService, HomeService $homeService)
    {
        //$this->middleware('auth');
        $this->loginService = $loginService;
        $this->homeService = $homeService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
		if (session()->has('user_id')) {
            $userid = session('user_id');

			$admintype = base64_decode($request->admintype);

			switch($admintype){
				case 'Super Admin':
					$page = 'dashboard/superadmin';
					break;
				case 'Admin':
					$page = 'dashboard/admin';
					break;
				case 'Rider':
					$page = 'dashboard/driver';
					break;
				case 'HRM':
					$page = 'dashboard/hrm';
					break;
				case 'Finance':
					$page = 'dashboard/finance';
					break;
				default:
					$page = 'dashboard/superadmin';
			}

            $homedata = $this->homeService->index();
            $deliveryinfo = $this->homeService->homedeliveryinfo();
            if ($homedata['status'] == true) {
				return view($page, [
					'prefixname' => 'Admin',
					'title' => 'Dashboard',
					'page_title' => 'Dashboard',
					'homeinfo' => $homedata['data'],
					'getResponse' => $deliveryinfo['data']
				]);
			}
			else {
				self::message('error', 'Data not found');
				return view('admin.pages.notfound');
			}
		}
		else {
            return redirect()->route('login');
        }
    }



	public function showlogin()
    {
		if (session()->has('user_id')) {
			return redirect('/');
		}
		else{
			return view('auth/login');
		}

    }

	public function login(Request $request)
    {
		try {
			$data = $request->all();
			$result = $this->loginService->postLogin($data);
			// dd($result);
			 if ($result['status'] == true) {
			 	  self::message('success', 'Login Successfully');
                 return redirect()->route('home');
            }
			else {
                return redirect()->back()->with('message',$result['message']);
            }

		} catch (\Exception $exception) {
            \Helper::handleException($exception);

			self::message('error', 'Something went wrong');
            return redirect()->back();
        }
    }

	public function logout()
    {
		try {

			$result = $this->loginService->logout();
			Session::flush();
			$request->session()->invalidate();
			return redirect('/');

		} catch (\Exception $exception) {
            \Helper::handleException($exception);

			self::message('error', 'Something went wrong');
            return redirect()->back();
        }
    }
}
