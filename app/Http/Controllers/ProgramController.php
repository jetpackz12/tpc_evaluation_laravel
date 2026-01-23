<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
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
            'programs' => Program::all()
        ];

        return view('admin.program_management.program_management', $render_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = array();
        $program = Program::where('program_code', $request->program_code)->first();

        if ($program) {
            $data = json_encode([
                'response' => $this->FAILED_RESPONSE,
                'message' => "Failed, This program code has already been used."
            ]);
        } else {
            $program = new program();
            $program->program_code = $request->program_code;
            $program->program_name = $request->program_name;
            $program->status = $this->ENABLED;
            $program->save();

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
        $program = Program::find($request->id);

        return json_encode($program);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
         $data = array();

        if ($request->old_program_code != $request->program_code) {

            $program = Program::where('program_code', $request->program_code)->first();

            if ($program) {
                $data = json_encode([
                    'response' => $this->FAILED_RESPONSE,
                    'message' => "Failed, This program code has already been used."
                ]);

                return $data;
            }
        }

        $program = Program::find($request->id);
        $program->program_code = $request->program_code;
        $program->program_name = $request->program_name;
        $program->save();

        $data = json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully update this program."
        ]);

        return $data;
    }

    /**
     * Update the status of the specified resource in storage.
     */
    public function status(Request $request)
    {
        $status = $request->status == $this->ENABLED ? $this->DISABLED : $this->ENABLED;

        $program = Program::find($request->id);
        $program->status = $status;
        $program->save();

        return json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully update the status of this program."
        ]);
    }
}
