<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConstructionController extends Controller
{
    //
    public function index()
    {
    	return view('admin.construction_schedules.schedule_list');
    }
    public function detail()
    {
    	return view('admin.construction_schedules.detail');
    }
}
