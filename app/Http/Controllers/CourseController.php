<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academic;
use App\Program;
use App\Level;

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
        $this->validate($request, [
            'academic' => 'required',
        ]);

        if($request->ajax())
        {
            return response(Academic::create($request->all()));
        }
    }

    public function postInsertProgram(Request $request)
    {
        $this->validate($request, [
            'program' => 'required',
            'description' => 'required',
        ]);

        if($request->ajax())
        {
            return response(Program::create($request->all()));
        }
    }

    public function postInsertLevel(Request $request)
    {
        $this->validate($request, [
            'level' => 'required',
            'description' => 'required',
        ]);

        if($request->ajax())
        {
            return response(Level::create($request->all()));
        }
    }

    public function showLevel(Request $request)
    {
        if($request->ajax())
        {
            return response(Level::where('program_id', $request->program_id)->get());
        }
    }
}
