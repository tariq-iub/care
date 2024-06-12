<?php

namespace App\Http\Controllers;

use App\Models\DataFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DataFileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataFiles = DataFile::with(['component', 'site'])->get();
        return view('admin.data.index', compact('dataFiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataFile $dataFile)
    {
        //
    }

    public function download(DataFile $dataFile)
    {
        //
    }

    public function upload(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:2048',
            'site_id' => 'required|exists:sites,id', // Ensure the machine component exists
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('csv_files', $fileName, 'public');

            // Store file metadata in the database
            DataFile::create([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'component_id' => $request->input('component_id'),
                'site_id' => $request->input('site_id'),
            ]);

            return response()->json(['message' => 'File uploaded successfully'], 200);
        }

        return response()->json(['message' => 'Invalid file upload'], 400);
    }
}
