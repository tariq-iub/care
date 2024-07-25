@extends('layouts.app')

@section('content')
    <form action="{{ route('setup.demodulation') }}" method="POST">
        @csrf
        <h2>Demodulation Setup</h2>

        <div>
            <label for="impact_demodulation">Impact Demodulation:</label>
            <input type="checkbox" id="impact_demodulation" name="impact_demodulation" value="1" {{ old('impact_demodulation') ? 'checked' : '' }}>
        </div>

        <div id="high_pass_filter_group" style="{{ old('impact_demodulation') ? 'display:none;' : '' }}">
            <label for="high_pass_filter">High Pass Filter:</label>
            <input type="text" id="high_pass_filter" name="high_pass_filter" value="{{ old('high_pass_filter') }}">
            @error('high_pass_filter')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <div id="band_pass_filter_group" style="{{ old('impact_demodulation') ? '' : 'display:none;' }}">
            <label for="band_pass_filter">Band Pass Filter:</label>
            <input type="text" id="band_pass_filter" name="band_pass_filter" value="{{ old('band_pass_filter') }}">
            @error('band_pass_filter')
            <div>{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Next</button>
    </form>

    <script>
        document.getElementById('impact_demodulation').addEventListener('change', function() {
            var isChecked = this.checked;
            document.getElementById('high_pass_filter_group').style.display = isChecked ? 'none' : '';
            document.getElementById('band_pass_filter_group').style.display = isChecked ? '' : 'none';
        });
    </script>
@endsection
