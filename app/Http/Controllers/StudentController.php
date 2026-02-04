<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Student;
use App\Models\StudentStatus;
use App\Models\User;
use App\Models\YearLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    private $SUCCESS_RESPONSE = '1';
    private $FAILED_RESPONSE = '0';
    private $DISABLED = '0';
    private $ENABLED = '1';
    private $RULE_STUDENT = 2;
    private $PENDING = 1;
    private $APPROVED = 2;
    private $CANCELLED = 3;
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

        $user = User::where("username", $request->student_identification)->first();

        if ($user) {
            $data = json_encode([
                'response' => $this->FAILED_RESPONSE,
                'message' => "Failed, This student identification has already been used."
            ]);
        } else {

            $user = new User();
            $user->name = "$request->firstname $request->middlename $request->lastname";
            $user->username = $request->student_identification;
            $user->password = $request->password;
            $user->role = $this->RULE_STUDENT;
            $user->save();

            $student = new Student();
            $student->user_id = $user->id;
            $student->last_name = $request->lastname;
            $student->first_name = $request->firstname;
            $student->middle_name = $request->middlename;
            $student->program_id = $request->program;
            $student->year_level_id = $request->year_level;
            $student->student_status_id = $request->status;
            $student->status = $this->PENDING;
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
    public function show(Request $request)
    {
        $data = array();

        $user = User::where("username", $request->identification)->first();

        $student = Student::where("user_id", $user->id)->first();

        if ($student->status != $this->APPROVED) {
            $data = json_encode([
                'response' => $this->FAILED_RESPONSE,
                'message' => "Failed, Account has not been approved by the admin."
            ]);
            
            return $data;
        }

        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);
            $request->session()->regenerate();

            $data = json_encode([
                'response' => $this->SUCCESS_RESPONSE,
                'message' => "Success, You have successfully logged in to your account."
            ]);
        } else {
            $data = json_encode([
                'response' => $this->FAILED_RESPONSE,
                'message' => "Failed, Username or password is invalid."
            ]);
        }

        return $data;
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

    /**
     * Student logout.
     */
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


    /**
     * Pending account
     */
    public function pendingAccount()
    {

        $render_data = [
            'students' => Student::join('users', 'students.user_id', 'users.id')
                ->select('students.*', 'users.username')
                ->where('status', $this->PENDING)
                ->get()
        ];

        return view('admin.student_management.pending_account', $render_data);
    }


    /**
     * Approved account
     */
    public function approvedAccount()
    {

        $render_data = [
            'students' => Student::join('users', 'students.user_id', 'users.id')
                ->select('students.*', 'users.username')
                ->where('status', $this->APPROVED)
                ->get()
        ];

        return view('admin.student_management.approved_account', $render_data);
    }


    /**
     * Cancelled account
     */
    public function cancelledAccount()
    {

        $render_data = [
            'students' => Student::join('users', 'students.user_id', 'users.id')
                ->select('students.*', 'users.username')
                ->where('status', $this->CANCELLED)
                ->get()
        ];

        return view('admin.student_management.cancelled_account', $render_data);
    }


    /**
     * Pending account update approved
     */
    public function accountUpdateApproved(Request $request)
    {
        $data = array();

        $student = Student::find($request->id);
        $student->status = $this->APPROVED;
        $student->save();

        $data = json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully approved student account."
        ]);

        return $data;
    }


    /**
     * Pending account update cancelled
     */
    public function accountUpdateCancel(Request $request)
    {
        $data = array();

        $student = Student::find($request->id);
        $student->status = $this->CANCELLED;
        $student->cancel_reason = $request->reason;
        $student->save();

        $data = json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully cancelled student account."
        ]);

        return $data;
    }

    /**
     *  Account update all
     */
    public function accountUpdateAll(Request $request)
    {
        $data = array();

        Student::whereIn('id', $request->selectedData)->update(['status' => $request->status]);

        $data = json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully approved all student accounts."
        ]);

        return $data;
    }
}
