<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
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
            'teachers' => Teacher::join('programs', 'teachers.program_id', '=', 'programs.id')
                ->select('teachers.id', 'teachers.id_num', 'teachers.lastname', 'teachers.firstname', 'teachers.middlename', 'teachers.middlename', 'teachers.status', 'programs.program_code', 'programs.program_name')
                ->get(),
            'programs' => Program::all()
        ];

        return view('admin.teacher_management.teacher_management', $render_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = array();

        $teacher = Teacher::where('id_num', $request->id_num)->first();

        if ($teacher) {
            $data = json_encode([
                'response' => $this->FAILED_RESPONSE,
                'message' => "Failed, This teacher identification has already been used."
            ]);
        } else {
            $teacher = new Teacher();
            $teacher->id_num = $request->id_num;
            $teacher->program_id = $request->program;
            $teacher->firstname = $request->firstname;
            $teacher->middlename = $request->middlename;
            $teacher->lastname = $request->lastname;
            $teacher->status = $this->ENABLED;
            $teacher->save();

            $data = json_encode([
                'response' => $this->SUCCESS_RESPONSE,
                'message' => "Success, You have successfully added new data."
            ]);
        }

        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $teacher = Teacher::find($request->id);

        return json_encode($teacher);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = array();

        if ($request->old_teacher_identification != $request->id_num) {

            $teacher = Teacher::where('id_num', $request->id_num)->first();

            if ($teacher) {
                $data = json_encode([
                    'response' => $this->FAILED_RESPONSE,
                    'message' => "Failed, This teacher identification has already been used."
                ]);

                return $data;
            }
        }

        $teacher = Teacher::find($request->id);
        $teacher->id_num = $request->id_num;
        $teacher->program_id = $request->program_id;
        $teacher->firstname = $request->firstname;
        $teacher->middlename = $request->middlename;
        $teacher->lastname = $request->lastname;
        $teacher->save();

        $data = json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully update this teacher."
        ]);

        return $data;
    }

    /**
     * Update the status of the specified resource in storage.
     */
    public function status(Request $request)
    {
        $status = $request->status == $this->ENABLED ? $this->DISABLED : $this->ENABLED;

        $teacher = Teacher::find($request->id);
        $teacher->status = $status;
        $teacher->save();

        return json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully update the status of this teacher."
        ]);
    }
}
