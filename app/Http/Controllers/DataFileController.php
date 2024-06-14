<?php

namespace App\Http\Controllers;

use App\Models\DataFile;
use App\Models\Device;
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request input
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
            'site_id' => 'required|exists:sites,id',
            'device_serial' => 'required|string|exists:devices,serial_number', // Ensure device is registered
        ]);

        // Find the device by serial number
        $device = Device::where('serial_number', $request->input('device_serial'))->first();

        // Check if the device exists
        if (!$device) {
            return response()->json(['message' => 'Device is not registered at system.'], 404);
        }

        // Check if the uploaded file is valid
        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('data_files', $fileName, 'public');

            // Store file metadata in the database
            $dataFile = DataFile::create([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'component_id' => $request->input('component_id'),
                'site_id' => $request->input('site_id'),
                'device_id' => $device->id,
            ]);

            return response()->json(['message' => 'File uploaded successfully.', 'data' => $dataFile], 201);
        }
        else {
            return response()->json(['message' => 'Invalid file upload'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataFile $dataFile)
    {
        $filePath = $dataFile->file_path;

        // Check if the file exists and delete it
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);
        }

        // Delete the database record
        $dataFile->delete();

        // Return a response indicating the file was deleted
        return response()->json(['message' => 'File deleted successfully.'], 200);
    }

    public function download(DataFile $dataFile)
    {
        $filePath = $dataFile->file_path;

        // Check if the file exists
        if (Storage::disk('public')->exists($filePath))
        {
            // Return the file as a download response
            return Storage::disk('public')->download($filePath, $dataFile->file_name);
        }
        else {
            // Return an error response if the file does not exist
            return response()->json(['message' => 'File not found.'], 404);
        }
    }

    public function upload(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:2048',
            'site_id' => 'required|exists:sites,id',
            'device_serial' => 'required|string|exists:devices,serial_number', // Ensure device is registered
        ]);

        $device = Device::where('serial_number', $request->input('device_serial'))->first();
        if (!$device) {
            return response()->json(['message' => 'Device is not registered at system.'], 404);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('data_files', $fileName, 'public');

            // Store file metadata in the database
            DataFile::create([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'component_id' => $request->input('component_id'),
                'site_id' => $request->input('site_id'),
                'device_id' => $device->id,
            ]);

            return response()->json(['message' => 'File uploaded successfully'], 200);
        }

        return response()->json(['message' => 'Invalid file upload'], 400);
    }
}
