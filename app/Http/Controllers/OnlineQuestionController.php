<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\OnlineQuestion;
use App\Models\ViewOnlineQuestion;

class OnlineQuestionController extends Controller
{
    private $SUCCESS_RESPONSE = '1';
    private $FAILED_RESPONSE = '0';
    private $DISABLED = '0';
    private $ENABLED = '1';
    private $ONLINE_MODALITY = '2';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $render_data = [
            'categories' => Category::where('status', $this->ENABLED)->get(),
            'online_questions' => ViewOnlineQuestion::all()
        ];

        return view('admin.evaluation_management.online_question', $render_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $onlineQuestion = new OnlineQuestion();
        $onlineQuestion->category_id = $request->category_name;
        $onlineQuestion->modality_id = $this->ONLINE_MODALITY;
        $onlineQuestion->question = $request->question;
        $onlineQuestion->status = $this->ENABLED;
        $onlineQuestion->save();

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
        $onlineQuestion = OnlineQuestion::find($request->id);

        return json_encode($onlineQuestion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $onlineQuestion = OnlineQuestion::find($request->id);
        $onlineQuestion->category_id = $request->category_name;
        $onlineQuestion->question = $request->question;
        $onlineQuestion->save();

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

        $onlineQuestion = OnlineQuestion::find($request->id);
        $onlineQuestion->status = $status;
        $onlineQuestion->save();

        return json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully update the status of this question."
        ]);
    }
}
