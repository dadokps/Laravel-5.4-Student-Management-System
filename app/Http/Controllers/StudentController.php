<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Academic;
use App\Program;
use App\Shift;
use App\Time;
use App\Batch;
use App\Group;
use App\MyClass;
use App\Student;
use App\Status;
use App\FileUpload;
use Illuminate\Support\Facades\Storage;

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
        $student_id  = Student::max('student_id');
        return view('student.studentRegister', compact('programs', 'academics', 'shifts', 'times', 'batches', 'groups', 'student_id'));
    }

    public function postStudentRegister(Request $request)
    {
        $student = new Student();
        $student->first_name = $request->first_name;
        $student->last_name  = $request->last_name;
        $student->sex = $request->sex;
        $student->dob = $request->dob;
        $student->email = $request->email;
        $student->rac = $request->rac;
        $student->status = $request->status;
        $student->nationality = $request->nationality;
        $student->national_card = $request->national_card;
        $student->passport = $request->passport;
        $student->phone = $request->phone;
        $student->village = $request->village;
        $student->commune = $request->commune;
        $student->district = $request->district;
        $student->province = $request->province;
        $student->current_address = $request->current_address;
        $student->dateregistered = $request->dateregistered;
        $student->user_id = $request->user_id;
        $student->photo = FileUpload::photo($request, 'photo');

        if($student->save())
        {
            $student_id = $student->student_id;
            Status::insert(['student_id' => $student_id, 'class_id' => $request->class_id]);
            return back();
        }
    }
}
