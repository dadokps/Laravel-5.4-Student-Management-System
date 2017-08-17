<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academic;
use App\Program;

class CourseController extends Controller
{
    public function __construct()
    {
       $this->middleware('web');
    }

    public function getManageCourse()
    {
        $academics = Academic::orderBy('academic_id', "DESC")->get();
        $programs  = Program::all();
        return view('courses.manage', compact('programs', 'academics'));
    }

    public function postInsertAcademic(Request $request)
    {
        if($request->ajax())
        {
            return response(Academic::create($request->all()));
        }
    }

    public function postInsertProgram(Request $request)
    {
        if($request->ajax())
        {
            return response(Program::create($request->all()));
        }
    }
}
