<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        return response()->json(Course::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'level' => 'required|string',
            'duration' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $course = Course::create($request->all());
        return response()->json($course, 201);
    }

    public function show(Course $course)
    {
        return response()->json($course, 200);
    }

    public function update(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'level' => 'string',
            'duration' => 'integer',
            'price' => 'numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $course->update($request->all());
        return response()->json($course, 200);
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(null, 204);
    }
}
