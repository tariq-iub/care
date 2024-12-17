<?php

namespace App\Http\Controllers;

use App\Models\FaultCodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FaultCodesController extends Controller
{
    public function index()
    {
        $faultCodes = FaultCodes::all();

        return view('admin.fault_codes.index', compact('faultCodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'description' => 'required',
        ]);

        FaultCodes::create($request->all());

        return redirect()->route('fault-codes.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required',
            'description' => 'required',
        ]);

        Log::info('', $request->all());

        $faultCode = FaultCodes::find($id);
        $faultCode->update($request->all());

        return redirect()->route('fault-codes.index');
    }

    public function destroy($id)
    {
        $faultCode = FaultCodes::find($id);
        $faultCode->delete();

        return redirect()->route('fault-codes.index');
    }

    public function fetchFaultCode($id)
    {
        $faultCode = FaultCodes::find($id);

        return response()->json($faultCode);
    }
}
