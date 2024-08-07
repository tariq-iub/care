<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NoteController extends Controller
{
    //


    public function saveNotesPictures(Request $request)
    {
        // Validate the request
        $validator = $request->validate([
            'plant_id' => 'required|integer',
            'notes' => 'nullable|string',
            'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $filepath = null;
        // Save notes
        $notes = $request->input('notes');

        // Handle picture uploads
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);

                $filepath = $filename;
            }
        }

        $note = Note::updateOrCreate(
            ['note' => $notes,
                'picture_path' => $filepath
            ],
        );
        $plant = Plant::where('id', $request->input('plant_id'))->firstOrFail();

        $plant->note_id = $note->id;
        $plant->save();

        return response()->json(['success' => true, 'notes' => $notes]);
    }

    function updateNotesPictures(Request $request)
    {
        if ($request->input('note_id') == null) {
            $validator = $request->validate([
                'plant_id' => 'required|integer',
                'notes' => 'nullable|string',
                'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $filepath = null;
            // Save notes
            $notes = $request->input('notes');

            // Handle picture uploads
            if ($request->hasFile('pictures')) {
                foreach ($request->file('pictures') as $file) {
                    $filename = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path('images'), $filename);

                    $filepath = $filename;
                }
            }

            $note = Note::updateOrCreate(
                ['note' => $notes,
                    'picture_path' => $filepath
                ],
            );
            $plant = Plant::where('id', $request->input('plant_id'))->firstOrFail();

            $plant->note_id = $note->id;
            $plant->save();

            return response()->json(['success' => true, 'notes' => $notes]);
        }

        $note = Note::where('id', $request->input('note_id'))->firstOrFail();

        $validator = $request->validate([
            'notes' => 'nullable|string',
            'pictures.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $picture_path = $note->picture_path;

        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $file) {
                $filename = time() . '-' . $file->getClientOriginalName();
                $file->move(public_path('images'), $filename);
                $picture_path = $filename;
            }
        }

        $note->update([
            'note' => $request->input('notes'),
            'picture_path' => $picture_path
        ]);

        return response()->json(['success' => true, 'notes' => $note]);
    }
}
