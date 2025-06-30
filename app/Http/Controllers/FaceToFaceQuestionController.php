<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FaceToFaceQuestion;
use App\Models\ViewFaceToFaceQuestion;
use Illuminate\Http\Request;

class FaceToFaceQuestionController extends Controller
{
    private $SUCCESS_RESPONSE = '1';
    private $FAILED_RESPONSE = '0';
    private $DISABLED = '0';
    private $ENABLED = '1';
    private $FACE_TO_FACE_MODALITY = '1';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $render_data = [
            'categories' => Category::where('status', $this->ENABLED)->get(),
            'face_to_face_questions' => ViewFaceToFaceQuestion::all()
        ];

        return view('admin.evaluation_management.facetoface_question', $render_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $faceToFaceQuestion = new FaceToFaceQuestion();
        $faceToFaceQuestion->category_id = $request->category_name;
        $faceToFaceQuestion->modality_id = $this->FACE_TO_FACE_MODALITY;
        $faceToFaceQuestion->question = $request->question;
        $faceToFaceQuestion->status = $this->ENABLED;
        $faceToFaceQuestion->save();

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
        $faceToFaceQuestion = FaceToFaceQuestion::find($request->id);

        return json_encode($faceToFaceQuestion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $faceToFaceQuestion = FaceToFaceQuestion::find($request->id);
        $faceToFaceQuestion->category_id = $request->category_name;
        $faceToFaceQuestion->question = $request->question;
        $faceToFaceQuestion->save();

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

        $faceToFaceQuestion = FaceToFaceQuestion::find($request->id);
        $faceToFaceQuestion->status = $status;
        $faceToFaceQuestion->save();

        return json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully update the status of this question."
        ]);
    }
}
