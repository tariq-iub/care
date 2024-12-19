<?php

namespace App\Http\Controllers;

use App\Models\DataFile;
use App\Models\Device;
use App\Models\Machine;
use App\Models\MachineVibrationLocations;
use App\Models\SensorData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;
use Yajra\DataTables\DataTables;

class DataFileController extends Controller
{
    public function index()
    {
        $devices = Device::all();
        $machines = Machine::all();
        $vibrationLocations = MachineVibrationLocations::all();

        return view('admin.data.index', compact('devices', 'machines', 'vibrationLocations'));
    }

    public function create()
    {
        $devices = Device::all();
        $machines = Machine::all();
        $vibrationLocations = MachineVibrationLocations::all();

        return view('admin.data.create', compact('devices', 'machines', 'vibrationLocations'));
    }

    public function edit(DataFile $dataFile)
    {
        $devices = Device::all();
        $machines = Machine::all();
        $vibrationLocations = MachineVibrationLocations::all();

        return view('admin.data.edit', compact('dataFile', 'devices', 'machines', 'vibrationLocations'));
    }

    public function show($id)
    {
        $dataFile = DataFile::find($id);

        if (!$dataFile) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->json($dataFile);
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048',
            'device_serial' => 'required|string|exists:devices,device_serial',
            'machine_id' => 'required|exists:machines,id',
            'vibration_location_id' => 'required|exists:machine_vibration_locations,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if the file exists and is valid
        if (!$request->hasFile('file') || !$request->file('file')->isValid()) {
            return redirect()->back()->withErrors(['file' => 'Invalid file upload.'])->withInput();
        }

        // Process the file
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('data_files', $fileName, 'public');

        // Retrieve the associated device
        $device = Device::where('device_serial', $request->input('device_serial'))->first();

        // Create the DataFile record
        DataFile::create([
            'file_name' => $fileName,
            'file_path' => $filePath,
            'device_id' => $device->id,
            'machine_id' => $request->input('machine_id'),
            'vibration_location_id' => $request->input('vibration_location_id'),
        ]);

        return redirect(route('files.index'))->with('success', 'Data file created successfully.');
    }

    public function update(Request $request, DataFile $dataFile)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'file' => 'sometimes|mimes:csv,txt,xlx,xls,pdf|max:2048',
            'device_serial' => 'required|string|exists:devices,device_serial',
            'machine_id' => 'required|exists:machines,id',
            'vibration_location_id' => 'required|exists:machine_vibration_locations,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if a new file is uploaded
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            if (!$file->isValid()) {
                return redirect()->back()->withErrors(['file' => 'Invalid file upload.'])->withInput();
            }

            // Process the new file
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('data_files', $fileName, 'public');

            // Delete the old file (optional)
            if ($dataFile->file_path && Storage::disk('public')->exists($dataFile->file_path)) {
                Storage::disk('public')->delete($dataFile->file_path);
            }

            // Update file information in the database
            $dataFile->file_name = $fileName;
            $dataFile->file_path = $filePath;
        }

        // Retrieve the associated device
        $device = Device::where('device_serial', $request->input('device_serial'))->first();

        if (!$device) {
            return redirect()->back()->withErrors(['device_serial' => 'The specified device does not exist.'])->withInput();
        }

        // Update other fields
        $dataFile->machine_id = $request->input('machine_id');
        $dataFile->device_id = $device->id;
        $dataFile->vibration_location_id = $request->input('vibration_location_id');

        $dataFile->save();

        return redirect(route('files.index'))->with('success', 'Data file updated successfully.');
    }

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

    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = DataFile::with(['device', 'machine.vibrationLocations'])->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('device', function ($row) {
                    return $row->device->serial_number;
                })
                ->addColumn('machine', function ($row) {
                    return $row->machine->machine_name;
                })
                ->addColumn('vibration_location', function ($row) {
                    return $row->machine->vibrationLocations;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    return view('admin.data.partial.action', compact('row'))->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function download(DataFile $dataFile)
    {
        $filePath = $dataFile->file_path;

        // Check if the file exists
        if (Storage::disk('public')->exists($filePath)) {
            // Return the file as a download response
            return Storage::disk('public')->download($filePath, $dataFile->file_name);
        } else {
            // Return an error response if the file does not exist
            return response()->json(['message' => 'File not found.'], 404);
        }
    }

    public function upload(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:csv,txt|max:2048',
            'machine' => 'required|exists:machines,id',
            'vibration_location' => 'required|exists:machine_vibration_locations,id',
            'device_serial' => 'required|string|exists:devices,serial_number',
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
            $dataFile = DataFile::create([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'device_id' => $device->id,
                'machine_id' => $request->input('machine'),
                'vibration_location_id' => $request->input('vibration_location'),
            ]);

            $this->process_file($dataFile);

            return response()->json(['message' => 'File uploaded successfully'], 200);
        }

        return response()->json(['message' => 'Invalid file upload'], 400);
    }

    private function process_file(DataFile $dataFile)
    {
        $filePath = $dataFile->file_path;

        if (Storage::disk('public')->exists($filePath)) {
            $csv = Reader::createFromPath(Storage::disk('public')->path($filePath), 'r');
            $csv->setHeaderOffset(0);
            $rows = $csv->getRecords();

            foreach ($rows as $row) {
                SensorData::create([
                    'data_file_id' => $dataFile->id,
                    'X' => $row['X'],
                    'Y' => $row['Y'],
                    'Z' => $row['Z'],
                ]);
            }
        }
    }

    public function replace(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:data_files,id',
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $dataFile = DataFile::find($request->input('id'));
        $oldFile = $dataFile->file_path;

        if ($request->file('file')->isValid()) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('data_files', $fileName, 'public');

            $dataFile->update([
                'file_name' => $fileName,
                'file_path' => $filePath,
            ]);

            // Check if the old file exists and delete it
            if (Storage::disk('public')->exists($oldFile)) {
                Storage::disk('public')->delete($oldFile);
            }

            return response()->json(['message' => 'File replaced successfully.', 'data' => $dataFile], 201);
        } else {
            return response()->json(['message' => 'Invalid file upload.'], 400);
        }
    }
}
