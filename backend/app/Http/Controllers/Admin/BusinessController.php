<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index(){
        {
            return view('admin.pages.partner.index');
        }
    }
    public function create(){
        {
            return view('admin.pages.partner.create');
        }
    }
}
