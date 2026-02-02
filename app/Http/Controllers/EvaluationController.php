<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Teacher;
use App\Models\Category;
use App\Models\Semester;
use App\Models\ViewTeacher;
use Illuminate\Http\Request;
use App\Models\OnlineQuestion;
use App\Models\FaceToFaceQuestion;
use App\Models\SubjectMatter;
use App\Models\SubjectMatterQuestion;
use App\Models\ViewEvaluation;
use App\Models\ViewEvaluationFaceToFace;
use App\Models\ViewEvaluationOnline;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
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
            'semesters' => Semester::all(),
            'face_to_face_questions' => FaceToFaceQuestion::where('status', $this->ENABLED)->get(),
            'online_questions' => OnlineQuestion::where('status', $this->ENABLED)->get(),
            'subject_matter_questions' => SubjectMatterQuestion::where('status', $this->ENABLED)->get(),
            'categories' => Category::where('status', $this->ENABLED)->get(),
        ];

        return view('admin.evaluation_result.evaluation_result', $render_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $teacher = ViewTeacher::all();

        if ($request->program_id > 0) {
            $teacher = ViewTeacher::where('program_id', '=', $request->program)->get();
        }

        return json_encode($teacher);
    }

    /**
     * Display the specified resources.
     */
    public function showEvaluation(Request $request)
    {

        $data = array();

        $data = [
            'teacher' => Teacher::find($request->id),
            'evaluations' => ViewEvaluation::where('teacher_id', '=', $request->id)
                ->where('semester_id', '=', $request->semester)
                ->where('academic_year', '=', $request->academic_year)
                ->get(),
            'subject_matters' => SubjectMatter::where('teacher_id', '=', $request->id)
                ->where('semester_id', '=', $request->semester)
                ->where('academic_year', '=', $request->academic_year)
                ->select(
                    'subject_matters.*',
                    'subject_matters.id AS subject_matter_id',
                    DB::raw('ROW_NUMBER() OVER (
                            PARTITION BY subject_matter_question_id
                            ORDER BY created_at
                        ) as number')
                )
                ->get(),
            'evaluation_facetoface' => ViewEvaluationFaceToFace::where('teacher_id', '=', $request->id)
                ->where('semester_id', '=', $request->semester)
                ->where('academic_year', '=', $request->academic_year)
                ->select('question_id', DB::raw('ROUND(AVG(rate), 2) as rate'))
                ->groupBy('question_id')
                ->get(),
            'evaluation_online' => ViewEvaluationOnline::where('teacher_id', '=', $request->id)
                ->where('semester_id', '=', $request->semester)
                ->where('academic_year', '=', $request->academic_year)
                ->select('question_id', DB::raw('ROUND(AVG(rate), 2) as rate'))
                ->groupBy('question_id')
                ->get()
        ];

        return json_encode($data);
    }
}
