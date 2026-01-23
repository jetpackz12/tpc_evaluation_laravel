<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\ViewSubject;
use App\Models\YearLevel;
use Illuminate\Http\Request;

class SubjectController extends Controller
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
            'semesters' => Semester::all(),
            'year_levels' => YearLevel::all(),
            'programs' => Program::where('status', $this->ENABLED)->get(),
            'subjects' => ViewSubject::all()
        ];

        return view('admin.subject_management.subject_management', $render_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array();
        $subject = Subject::where('subject_code', $request->subject_code)->first();

        if ($subject) {
            $data = json_encode([
                'response' => $this->FAILED_RESPONSE,
                'message' => "Failed, This subject code has already been used."
            ]);
        } else {
            $subject = new Subject();
            $subject->subject_code = $request->subject_code;
            $subject->subject_name = $request->subject_name;
            $subject->semester_id = $request->semester;
            $subject->year_level_id = $request->year_level;
            $subject->program_id = $request->program;
            $subject->status = $this->ENABLED;
            $subject->save();

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
        $subject = Subject::find($request->id);

        return json_encode($subject);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = array();

        if ($request->old_subject_code != $request->subject_code) {

            $subject = Subject::where('subject_code', $request->subject_code)->first();

            if ($subject) {
                $data = json_encode([
                    'response' => $this->FAILED_RESPONSE,
                    'message' => "Failed, This subject code has already been used."
                ]);

                return $data;
            }
        }

        $subject = Subject::find($request->id);
        $subject->subject_code = $request->subject_code;
        $subject->subject_name = $request->subject_name;
        $subject->semester_id = $request->semester;
        $subject->year_level_id = $request->year_level;
        $subject->program_id = $request->program;
        $subject->save();

        $data = json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully update this subject."
        ]);

        return $data;
    }

    /**
     * Update the status of the specified resource in storage.
     */
    public function status(Request $request)
    {
        $status = $request->status == $this->ENABLED ? $this->DISABLED : $this->ENABLED;

        $subject = Subject::find($request->id);
        $subject->status = $status;
        $subject->save();

        return json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully update the status of this subject."
        ]);
    }
}
