<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Student List',
            'data' => Student::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', 'unique:students'],
            'course' => ['required'],
            'phone' => ['required']
        ]);
        $student = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'course' => $request->course,
            'phone' => $request->phone
        ]);

        if ($student) {
            return response()->json([
                'success' => true,
                'message' => 'Student Created',
                'data' => $student
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Student Failed to Save',
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
//        $student = Student::findOrFail($id);
        try {
            return response()->json([
                'success' => true,
                'message' => 'Student Get',
                'data' => Student::findOrFail($id)
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Student Not Found!',
                'data' => $e->getMessage(),
            ], 409);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email'],
            'course' => ['required'],
            'phone' => ['required']
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Student Updated',
            'data' => Student::findOrFail($id)->update($request->all())
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        return response()->json([
            'success' => true,
            'message' => 'Student Deleted',
            'data' => Student::findOrFail($id)->delete()
        ]);
    }
}
