<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FaceToFaceQuestion;
use App\Models\OnlineQuestion;
use App\Models\Program;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $PENDING = 1;
    private $APPROVED = 2;
    private $CANCELLED = 3;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $render_data = [
            'student_pendings' => Student::where('status', $this->PENDING)->count(),
            'student_approveds' => Student::where('status', $this->APPROVED)->count(),
            'student_cancelleds' => Student::where('status', $this->CANCELLED)->count(),
            'teachers' => Teacher::count(),
            'programs' => Program::count(),
            'subjects' => Subject::count(),
            'categories' => Category::count(),
            'face_to_faces_questions' => FaceToFaceQuestion::count(),
            'online_questions' => OnlineQuestion::count(),
        ];

        return view('admin.dashboard.dashboard', $render_data);
    }

}
