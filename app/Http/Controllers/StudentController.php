<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Student;
use App\Models\StudentStatus;
use App\Models\YearLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    private $SUCCESS_RESPONSE = '1';
    private $FAILED_RESPONSE = '0';
    private $DISABLED = '0';
    private $ENABLED = '1';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $render_data = [
            'programs' => Program::all(),
            'year_levels' => YearLevel::all(),
            'student_status' => StudentStatus::all(),
        ];

        return view('student.login.registration', $render_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array();

        $student = Student::where("student_identification", $request->student_identification)->first();

        if ($student) {
            $data = json_encode([
                'response' => $this->FAILED_RESPONSE,
                'message' => "Failed, This student identification has already been used."
            ]);
        } else {
            $student = new Student();
            $student->last_name = $request->lastname;
            $student->first_name = $request->firstname;
            $student->middle_name = $request->middlename;
            $student->program_id = $request->program;
            $student->year_level_id = $request->year_level;
            $student->student_status_id = $request->status;
            $student->student_identification = $request->student_identification;
            $student->password = Hash::make($request->password);
            $student->status = $this->ENABLED;
            $student->save();
            
            $data = json_encode([
                'response' => $this->SUCCESS_RESPONSE,
                'message' => "Success, You have successfully registered your account."
            ]);
        }
        
        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(student $student)
    {
        //
    }
}
