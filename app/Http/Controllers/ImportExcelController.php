<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ScheduleImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelController extends Controller
{
    //
    public function import() 
    {

        Excel::import(new ScheduleImport,request()->file('file'));
        return redirect('/manageSchedule/schedule');
    }
}
