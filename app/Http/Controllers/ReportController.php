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
use App\Student;
use App\Status;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
   public function getStudentList()
   {
       $academics  = Academic::orderBy('academic_id', "DESC")->get();
       $programs   = Program::all();
       $shifts     = Shift::all();
       $times      = Time::all();
       $batches    = Batch::all();
       $groups     = Group::all();
       $student_id = Student::max('student_id');

       return view('report.studentList', compact('programs', 'academics', 'shifts', 'times', 'batches', 'groups', 'student_id'));
   }

    public function showStudentInfo(Request $request)
    {
        $classes = $this->info($request->class_id);
        return view('report.studentInfo', compact('classes'));
    }

    public function info($class_id)
    {
        return Status::join('classes', 'classes.class_id', '=', 'statuses.class_id')
                    ->join('students', 'students.student_id', '=', 'statuses.student_id')
            ->join('levels', 'levels.level_id', '=', 'classes.level_id')
            ->join('programs', 'programs.program_id', '=', 'levels.program_id')
            ->join('academics', 'academics.academic_id', '=', 'classes.academic_id')
                    ->join('shifts', 'shifts.shift_id', '=', 'classes.shift_id')
                    ->join('times', 'times.time_id', '=', 'classes.time_id')
                    ->join('batches', 'batches.batch_id', '=', 'classes.batch_id')
                    ->join('groups', 'groups.group_id', '=', 'classes.group_id')
                    ->select(DB::raw('students.student_id,
                                    CONCAT(students.first_name," ",students.last_name) as name,
                                    (CASE WHEN students.sex=0 THEN "Male" ELSE "Female" END) as sex,
                                    students.dob, CONCAT(programs.program," / ",levels.level, " / ", shifts.shift," / ",times.time, " Start-(",classes.start_date, "/", classes.end_date, ")") as program '))
            ->where('classes.class_id', $class_id)->get()
            ;
    }
}
