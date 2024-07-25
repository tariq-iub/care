@extends('layouts.app')

@section('content')
    <form action="{{ route('setup.measurement') }}" method="POST">
        @csrf
        <h2>Measurement Setup</h2>

        <div>
            <label for="average_type">Average Type:</label>
            <select id="average_type" name="average_type">
                <option value="spectral">Spectral</option>
                <option value="time_synchronous">Time Synchronous</option>
            </select>
            @error('average_type')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="number_of_averages">Number of Averages:</label>
            <input type="number" id="number_of_averages" name="number_of_averages" value="{{ old('number_of_averages') }}">
            @error('number_of_averages')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="average_overlap_percentage">Average Overlap Percentage:</label>
            <select id="average_overlap_percentage" name="average_overlap_percentage">
                <option value="0">0%</option>
                <option value="12.5">12.5%</option>
                <option value="25">25%</option>
                <option value="37.5">37.5%</option>
                <option value="50">50%</option>
                <option value="62.5">62.5%</option>
                <option value="75">75%</option>
            </select>
            @error('average_overlap_percentage')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="window_type">Window Type:</label>
            <select id="window_type" name="window_type">
                <option value="hanning">Hanning</option>
                <option value="hamming">Hamming</option>
                <option value="flat_top">Flat Top</option>
                <option value="rectangular">Rectangular</option>
            </select>
            @error('window_type')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Next</button>
    </form>
@endsection
