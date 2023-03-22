<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function index()
    {
        $tutoriel = Tutorial::all();
        return response()->json($tutoriel);
    }

    public function store(Request $request)
    {
        $tutoriel = new Tutorial([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        $tutoriel->save();
        return response()->json([
            'messages' => 'Tutoriel created',
            'data' => $tutoriel
        ], 200);
    }

    public function show($id)
    {
        $tutoriel = Tutorial::findOrFail($id);
        return response()->json($tutoriel);
    }

    public function update($id, Request $request)
    {
        $tutoriel = Tutorial::findOrFail($id);
        $tutoriel->update($request->all());
        return response()->json([
            'messages' => 'Tutoriel updated',
            'data' => $tutoriel
        ]);
    }

    public function destroy($id)
    {
        return Tutorial::findOrFail($id)->delete();
    }

    public function deleteAll()
    {
        $alls = Tutorial::all();
        foreach($alls as $all)
        {
            Tutorial::find($all->id)->delete();
        }
        return response()->json('Deleted!');
    }

    public function chercher(Request $request)
    {
        $query = $request->input('title');

        $tutoriel = Tutorial::where('title', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%")
                    ->get();

        return response()->json($tutoriel);
    }
}
