<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    public function index()
    {
        return response()->json(Teacher::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'specialties' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $teacher = Teacher::create($request->all());
        return response()->json($teacher, 201);
    }

    public function show(Teacher $teacher)
    {
        return response()->json($teacher, 200);
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'bio' => 'nullable|string',
            'specialties' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $teacher->update($request->all());
        return response()->json($teacher, 200);
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return response()->json(null, 204);
    }
}
