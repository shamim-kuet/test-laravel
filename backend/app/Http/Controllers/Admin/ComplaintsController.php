<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ComplaintsController extends Controller
{
    public function index()
    {
        return view('admin.pages.complaint.index', [
            'prefixname' => 'Complaint',
            'title' => 'Complaint List',
            'page_title' => 'Complaint List',

        ]);
    }
}
