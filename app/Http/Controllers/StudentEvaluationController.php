<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Evaluation;
use App\Models\FaceToFaceQuestion;
use App\Models\OnlineQuestion;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectMatter;
use App\Models\SubjectMatterQuestion;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StudentEvaluationController extends Controller
{
    private $SUCCESS_RESPONSE = '1';
    private $FAILED_RESPONSE = '0';
    private $DISABLED = '0';
    private $ENABLED = '1';
    private $FACETOFACEQUESTION = 1;
    private $ONLINEQUESTION = 2;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $render_data = [
            'programs' => Program::all(),
            'semesters' => Semester::all()
        ];
        
        if (Session::has('instructor') && Session::has('subjects') && Session::has('academic_year')) {

            $render_data += [
                'face_to_face_questions' => FaceToFaceQuestion::where('status', $this->ENABLED)->get(),
                'online_questions' => OnlineQuestion::where('status', $this->ENABLED)->get(),
                'subject_matter_questions' => SubjectMatterQuestion::where('status', $this->ENABLED)->get(),
                'categories' => Category::where('status', $this->ENABLED)->get(),
            ];

            return view('student.evaluation.evaluation_form', $render_data);
        }

        return view('student.evaluation.evaluation', $render_data);
    }

    /**
     * Get instructor datas
     */
    public function getInstructor(Request $request)
    {
        $teacher = Teacher::where('program_id', '=', $request->id)->get();

        return json_encode($teacher);
    }

    /**
     * Get subject datas
     */
    public function getSubject(Request $request)
    {
        $subject = Subject::where('semester_id', '=', $request->id)->get();

        return json_encode($subject);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

        $data = array();
        
        $student = Student::where('user_id', Auth::user()->id)->first();
        $evaluation = Evaluation::where('student_id', '=', $student->id)
                            ->where('teacher_id', '=', $request->instructor)
                            ->where('academic_year', '=', $request->academic_year)
                            ->where('semester_id', '=', $request->semester)
                            ->first();

        if ($evaluation) {
            $data = json_encode([
                'response' => $this->FAILED_RESPONSE,
                'message' => "Failed, You have already evaluated this instructor."
            ]);
        } else {
            Session::push('program', $request->program);
            Session::push('instructor', $request->instructor);
            Session::push('semester', $request->semester);
            Session::push('subjects', $request->subjects);
            Session::push('academic_year', $request->academic_year);
            
            $data = json_encode([
                'response' => $this->SUCCESS_RESPONSE,
                'message' => "Success, You may start the evaluation."
            ]);
        }

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = array();
        $instructor = Session::get('instructor')[0];
        $subjects = implode(",", Session::get('subjects')[0]);
        $academic_year = Session::get('academic_year')[0];
        $semester = Session::get('semester')[0];

        $student = Student::where('user_id', Auth::user()->id)->first();

        for ($i=0; $i < count($request->faceToFace); $i++) { 
			$arr_question = explode('|', $request->faceToFace[$i]);

            $evaluation = new Evaluation();
            $evaluation->student_id = $student->id;
            $evaluation->teacher_id = $instructor;
            $evaluation->subject_id = $subjects;
            $evaluation->academic_year = $academic_year;
            $evaluation->semester_id = $semester;

            $evaluation->rate = $arr_question['0'];
            $evaluation->category_id = $arr_question['1'];
            $evaluation->modality_id = $arr_question['2'];
            $evaluation->question_id = $arr_question['3'];
            
            $evaluation->save();
        }

        for ($i=0; $i < count($request->online); $i++) { 
			$arr_question = explode('|', $request->online[$i]);

            $evaluation = new Evaluation();
            $evaluation->student_id = $student->id;
            $evaluation->teacher_id = $instructor;
            $evaluation->subject_id = $subjects;
            $evaluation->academic_year = $academic_year;
            $evaluation->semester_id = $semester;

            $evaluation->rate = $arr_question['0'];
            $evaluation->category_id = $arr_question['1'];
            $evaluation->modality_id = $arr_question['2'];
            $evaluation->question_id = $arr_question['3'];
            
            $evaluation->save();
        }

        for ($i=0; $i < count($request->knowledge_id); $i++) { 
            $subject_matter = new SubjectMatter();
            
            $subject_matter->student_id = $student->id;
            $subject_matter->teacher_id = $instructor;
            $subject_matter->subject_id = $subjects;
            $subject_matter->academic_year = $academic_year;
            $subject_matter->semester_id = $semester;

            $subject_matter->subject_matter_question_id = $request->knowledge_id[$i];
            $subject_matter->response = $request->question[$i];
            
            $subject_matter->save();
        }

        $data = json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully added new data."
        ]);

        Session::forget('program');
        Session::forget('instructor');
        Session::forget('semester');
        Session::forget('subjects');
        Session::forget('academic_year');

        return $data;
    }
}
