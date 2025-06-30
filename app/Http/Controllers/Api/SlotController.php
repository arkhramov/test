<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slot;
use App\Models\Bonus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SlotController extends Controller
{
    public function index(Request $request)
    {
        $query = Slot::query();

        if ($request->filled('provider')) {
            $query->where('provider', $request->provider);
        }

        if ($request->filled('sort')) {
            $query->orderBy('provider', $request->sort === 'desc' ? 'desc' : 'asc');
        }

        return response()->json($query->get());
    }

    public function show($id)
    {
        $slot = Slot::findOrFail($id);
        return response()->json($slot);
    }

    public function activateBonus(Request $request, Slot $slot)
    {
        $sessionId = $request->session()->getId();

        $bonus = Bonus::where('slot_id', $slot->id)
            ->where('session_id', $sessionId)
            ->first();

        if ($bonus) {
            return response()->json(['status' => 'already_activated', 'message' => 'Bonus already activated']);
        }

        Bonus::create([
            'slot_id' => $slot->id,
            'session_id' => $sessionId,
            'activated_at' => Carbon::now(),
        ]);

        return response()->json(['status' => 'activated', 'message' => 'Bonus successfully activated']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'provider' => 'required|string',
            'image_url' => 'required|url',
            'description' => 'required|string',
        ]);

        $slot = Slot::create($data);

        return response()->json($slot, 201);
    }
}
