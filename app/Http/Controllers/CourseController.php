<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academic;
use App\Program;
use App\Level;
use App\Shift;
use App\Time;
use App\Batch;
use App\Group;

class CourseController extends Controller
{
    public function __construct()
    {
       $this->middleware('web');
    }

    public function getManageCourse()
    {
        $academics  = Academic::orderBy('academic_id', "DESC")->get();
        $programs   = Program::all();
        $shifts     = Shift::all();
        $times      = Time::all();
        $batches    = Batch::all();
        $groups     = Group::all();
        return view('courses.manage', compact('programs', 'academics', 'shifts', 'times', 'batches', 'groups'));
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

    public function postInsertShift(Request $request)
    {
        $this->validate($request, [
            'shift' => 'required',
        ]);

        if($request->ajax())
        {
            return response(Shift::create($request->all()));
        }
    }

    public function postInsertTime(Request $request)
    {
        $this->validate($request, [
            'time' => 'required',
        ]);

        if($request->ajax())
        {
            return response(Time::create($request->all()));
        }
    }

    public function postInsertBatch(Request $request)
    {
        $this->validate($request, [
            'batch' => 'required',
        ]);

        if($request->ajax())
        {
            return response(Batch::create($request->all()));
        }
    }

    public function postInsertGroup(Request $request)
    {
        $this->validate($request, [
            'group' => 'required',
        ]);

        if($request->ajax())
        {
            return response(Group::create($request->all()));
        }
    }
}
