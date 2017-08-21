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
use App\MyClass;


class StudentController extends Controller
{
    public function getStudentRegister()
    {
        $academics  = Academic::orderBy('academic_id', "DESC")->get();
        $programs   = Program::all();
        $shifts     = Shift::all();
        $times      = Time::all();
        $batches    = Batch::all();
        $groups     = Group::all();

        return view('student.studentRegister', compact('programs', 'academics', 'shifts', 'times', 'batches', 'groups'));
    }

    public function postStudentRegister(Request $request)
    {
        return $request->all();
    }
}
