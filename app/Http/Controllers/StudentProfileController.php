<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Student;
use App\Models\StudentStatus;
use App\Models\User;
use App\Models\YearLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
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
            'student' => Student::join('users', 'students.user_id', 'users.id')
                ->select('students.*', 'users.username', 'users.password')
                ->where('students.user_id', '=', Auth::user()->id)
                ->first(),
            'programs' => Program::all(),
            'year_levels' => YearLevel::all(),
            'status' => StudentStatus::all()
        ];

        return view('student.profile.profile', $render_data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $data = array();

        if ($request->old_student_identification != $request->student_identification) {
            
            $user = User::where('username', '=', $request->student_identification)->first();

            if ($user) {
                $data = json_encode([
                    'response' => $this->FAILED_RESPONSE,
                    'message' => 'Failed, This student identification has already been used.'
                ]);

                return $data;
            }
        }

        $user = User::find($request->id_user);
        $user->name = "$request->firstname $request->middlename $request->lastname";
        $user->username = $request->student_identification;

        if ($request->e_old_password != $request->password) {
            $user->password = $request->password;
        }

        $user->save();

        $student = Student::find($request->id_student);
        $student->last_name = $request->lastname;
        $student->first_name = $request->firstname;
        $student->middle_name = $request->middlename;
        $student->program_id = $request->program;
        $student->year_level_id = $request->year_level;
        $student->student_status_id = $request->status;
        $student->save();

        $data = json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => 'Success, You have successfully update your account.'
        ]);

        return $data;
    }
}
