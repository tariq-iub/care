@extends('layouts.care')

@section('content')
    <form action="{{ route('setup.general') }}" method="POST">
        @csrf
        <h2>General Setup</h2>

        <div>
            <label for="cutoff_frequency">Cut-off Frequency:</label>
            <input type="text" id="cutoff_frequency" name="cutoff_frequency" value="{{ old('cutoff_frequency') }}">
            @error('cutoff_frequency')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="resolution">Resolution:</label>
            <input type="text" id="resolution" name="resolution" value="{{ old('resolution') }}">
            @error('resolution')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="transducer_type">Transducer Type:</label>
            <select id="transducer_type" name="transducer_type">
                <option value="accelerometer">Accelerometer</option>
                <option value="velocity_probe">Velocity Probe</option>
                <option value="proximity_probe">Proximity Probe</option>
                <option value="volts_dynamic">Volts Dynamic</option>
            </select>
            @error('transducer_type')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="sensitivity">Sensitivity:</label>
            <input type="text" id="sensitivity" name="sensitivity" value="{{ old('sensitivity') }}">
            @error('sensitivity')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="unit">Unit:</label>
            <select id="unit" name="unit">
                <option value="unit1">Unit 1</option>
                <option value="unit2">Unit 2</option>
                <!-- Add more options as needed -->
            </select>
            @error('unit')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Next</button>
    </form>
@endsection
