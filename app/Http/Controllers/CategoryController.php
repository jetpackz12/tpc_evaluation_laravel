<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
            'categories' => Category::all(),
        ];

        return view('admin.category_management.category_management', $render_data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->status = $this->ENABLED;
        $category->save();

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
        $category = Category::find($request->id);

        return json_encode($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->category_name = $request->category_name;
        $category->save();

        return json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully update this category."
        ]);
    }

    /**
     * Update the status of the specified resource in storage.
     */
    public function status(Request $request)
    {
        $status = $request->status == $this->ENABLED ? $this->DISABLED : $this->ENABLED;

        $category = Category::find($request->id);
        $category->status = $status;
        $category->save();

        return json_encode([
            'response' => $this->SUCCESS_RESPONSE,
            'message' => "Success, You have successfully update the status of this category."
        ]);
    }
}
