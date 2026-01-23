<?php

namespace App\Http\Controllers;

use App\Models\SubjectMatterQuestion;
use Illuminate\Http\Request;

class SubjectMatterQuestionController extends Controller
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
            'subject_matter_questions' => SubjectMatterQuestion::orderBy('id', 'DESC')->get()
        ];

        return view('admin.evaluation_management.subject_matter_question', $render_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $subjectMatterQuestion = new SubjectMatterQuestion();
        $subjectMatterQuestion->question = $request->question;
        $subjectMatterQuestion->status = $this->ENABLED;
        $subjectMatterQuestion->save();

        return json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully added new data."
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $subjectMatterQuestion = SubjectMatterQuestion::find($request->id);

        return json_encode($subjectMatterQuestion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $subjectMatterQuestion = SubjectMatterQuestion::find($request->id);
        $subjectMatterQuestion->question = $request->question;
        $subjectMatterQuestion->save();

        return json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully update this question."
        ]);
    }

    /**
     * Update the status of the specified resource in storage.
     */
    public function status(Request $request)
    {
        $status = $request->status == $this->ENABLED ? $this->DISABLED : $this->ENABLED;

        $subjectMatterQuestion = SubjectMatterQuestion::find($request->id);
        $subjectMatterQuestion->status = $status;
        $subjectMatterQuestion->save();

        return json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully update the status of this question."
        ]);
    }
}
