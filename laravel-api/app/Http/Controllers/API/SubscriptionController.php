<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscriptionController extends Controller
{
    public function index()
    {
        return response()->json(Subscription::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|exists:students,id',
            'type' => 'required|string',
            'started_at' => 'required|date',
            'expires_at' => 'required|date|after:started_at',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $subscription = Subscription::create($request->all());
        return response()->json($subscription, 201);
    }

    public function show(Subscription $subscription)
    {
        return response()->json($subscription, 200);
    }

    public function update(Request $request, Subscription $subscription)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'exists:students,id',
            'type' => 'string',
            'started_at' => 'date',
            'expires_at' => 'date|after:started_at',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $subscription->update($request->all());
        return response()->json($subscription, 200);
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return response()->json(null, 204);
    }
}
