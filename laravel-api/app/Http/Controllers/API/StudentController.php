<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        return response()->json(Student::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:students,email',
            'subscription_expires_at' => 'nullable|date',
            'status' => 'string|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $student = Student::create($request->all());
        return response()->json($student, 201);
    }

    public function show(Student $student)
    {
        return response()->json($student, 200);
    }

    public function update(Request $request, Student $student)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'email' => 'string|email|unique:students,email,'.$student->id,
            'subscription_expires_at' => 'nullable|date',
            'status' => 'string|in:active,inactive',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $student->update($request->all());
        return response()->json($student, 200);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(null, 204);
    }
}
