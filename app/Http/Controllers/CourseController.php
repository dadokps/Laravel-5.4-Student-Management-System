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

    public function postCreateClass(Request $request)
    {
        $this->validate($request, [
            'academic_id' => 'required',
            'level_id' => 'required',
            'shift_id' => 'required',
            'time_id' => 'required',
            'group_id' => 'required',
            'batch_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'active' => 'required',
        ]);

        if($request->ajax())
        {
            return response(MyClass::create($request->all()));
        }
    }

    public function ClassInfo($criterial)
    {
        return MyClass::join('academics', 'academics.academic_id', '=', 'classes.academic_id')
            ->join('levels', 'levels.level_id', '=', 'classes.level_id')
            ->join('programs', 'programs.program_id', '=', 'levels.program_id')
            ->join('shifts', 'shifts.shift_id', '=', 'classes.shift_id')
            ->join('times', 'times.time_id', '=', 'classes.time_id')
            ->join('batches', 'batches.batch_id', '=', 'classes.batch_id')
            ->join('groups', 'groups.group_id', '=', 'classes.group_id')
            ->where($criterial)
            ->orderBy('classes.class_id', 'DESC');
    }

    public function showClassInfo(Request $request)
    {
        $criterial = array();
        if ($request->academic_id != "" && $request->program_id == "")
        {
            $criterial = array('academics.academic_id' => $request->academic_id);

        } elseif ($request->academic_id != "" && $request->program_id != "" && $request->level_id != "" &&
                  $request->shift_id    != "" && $request->time_id    != "" && $request->batch_id   != "" && $request->group_id != "")
        {
            $criterial = array('academics.academic_id' => $request->academic_id,
                               'programs.program_id'   => $request->program_id,
                               'levels.level_id'       => $request->level_id,
                               'shifts.shift_id'       => $request->shift_id,
                               'times.time_id'         => $request->time_id,
                               'batches.batch_id'      => $request->batch_id,
                               'groups.group_id'       => $request->group_id
            );
        }
        $classes = $this->ClassInfo($criterial)->get();
        return view('class.classInfo', compact('classes'));
    }

    public function deleteClass(Request $request)
    {
        if($request->ajax())
        {
            MyClass::destroy($request->class_id);
        }
    }

    public function editClass(Request $request)
    {
        if($request->ajax())
        {
            return response(MyClass::find($request->class_id));
        }
    }

    public function updateClassInfo(Request $request)
    {
        if($request->ajax())
        {
            return response(MyClass::updateOrCreate(['class_id' => $request->class_id], $request->all()));
        }
    }
}
