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
use App\FileUpload;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    /**
     * Get the view for student registration
     *
     * @return Response
     */

    public function getStudentRegister()
    {
        $academics  = Academic::orderBy('academic_id', "DESC")->get();
        $programs   = Program::all();
        $shifts     = Shift::all();
        $times      = Time::all();
        $batches    = Batch::all();
        $groups     = Group::all();
        $student_id = Student::max('student_id');

        return view('student.studentRegister', compact('programs', 'academics', 'shifts', 'times', 'batches', 'groups', 'student_id'));
    }

    /**
     * Save student in the database.
     *
     * @param  Request  $request
     * @return Response
     */

    public function postStudentRegister(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required|min:3|max:255',
            'last_name' => 'required|min:3|max:255',
            'sex' => 'required|integer',
            'dateOfBirth' => 'required|date_format:Y-m-d',
            'email' => 'required|email|max:50',
            'national_card' => 'required|max:255',
            'status' => 'required|integer',
            'nationality' => 'required|max:50',
            'rac' => 'required|max:50',
            'phone' => 'required|max:50',
            'passport' => 'required|max:50',
            'photo' => 'required|mimes:jpeg,bmp,png,jpg,x-png',
            'class_id' => 'required',
        ], [
                'class_id.required' => 'Please choose academic',
            ]
        );

        $student = new Student();
        $student->first_name = $request->first_name;
        $student->last_name  = $request->last_name;
        $student->sex = $request->sex;
        $student->dob = $request->dateOfBirth;
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

            // Save student id in the given class
            Status::insert(['student_id' => $student_id, 'class_id' => $request->class_id]);

            session()->flash('message', 'Student has been successfully registered!');

            return redirect()->route('goPayment', ['student_id' => $student_id]);
        }
    }

    /**
     * Get informations of students.
     *
     * @param  Request  $request
     * @return Response
     */

    public function studentInfo(Request $request)
    {
        if($request->has('search'))
        {
            $students = Student::where('student_id', $request->search)
                                ->orWhere('first_name', 'LIKE', '%'. $request->search .'%')
                                ->orWhere('last_name', 'LIKE', '%'. $request->search .'%')
                                ->select(DB::raw('student_id,
                                                  first_name,
                                                  last_name,
                                                  CONCAT(first_name, " ", last_name) as full_name,
                                                  (CASE WHEN sex=0 THEN "M" ELSE "F" END) as sex,
                                                  dob'))
                                ->paginate(10)
                                ->appends('search', $request->search);
        } else {

            $students = Student::select(DB::raw('student_id,
                                                  first_name,
                                                  last_name,
                                                  CONCAT(first_name, " ", last_name) as full_name,
                                                  (CASE WHEN sex=0 THEN "M" ELSE "F" END) as sex,
                                                  dob'))
                                ->paginate(10);
        }

        return view('student.studentList', compact('students'));
    }
}
