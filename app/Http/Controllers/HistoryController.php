<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\SubjectMatter;
use App\Models\OnlineQuestion;
use App\Models\ViewEvaluation;
use App\Models\FaceToFaceQuestion;
use App\Models\SubjectMatterQuestion;

class HistoryController extends Controller
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
            'teachers' => Teacher::all(),
            'face_to_face_questions' => FaceToFaceQuestion::where('status', $this->ENABLED)->get(),
            'online_questions' => OnlineQuestion::where('status', $this->ENABLED)->get(),
            'subject_matter_questions' => SubjectMatterQuestion::where('status', $this->ENABLED)->get(),
            'categories' => Category::where('status', $this->ENABLED)->get(),
        ];

        return view('student.history.history', $render_data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // dd($request);

        $data = [
            'evaluations' => ViewEvaluation::where('teacher_id', '=', $request->teacher_id)
                ->where('academic_year', '=', $request->academic_year)
                ->where('semester_id', '=', $request->semester)
                ->get(),
            'subject_matters' => SubjectMatter::where('teacher_id', '=', $request->teacher_id)
                ->where('semester_id', '=', $request->semester)
                ->where('academic_year', '=', $request->academic_year)
                ->select('subject_matters.*', 'subject_matters.id AS subject_matter_id')
                ->get()
        ];


        return json_encode($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
