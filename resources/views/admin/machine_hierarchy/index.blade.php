@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hierarchy</h1>
        @foreach($companies as $company)
            <div class="mb-3">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Company: {{ $company->name }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#plants-{{ $company->id }}">
                                View Plants
                            </button>
                            <div id="plants-{{ $company->id }}" class="collapse">
                                @foreach($company->plants as $plant)
                                    <table class="table table-bordered mt-2">
                                        <thead>
                                        <tr>
                                            <th>Plant: {{ $plant->name }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#areas-{{ $plant->id }}">
                                                    View Areas
                                                </button>
                                                <div id="areas-{{ $plant->id }}" class="collapse">
                                                    @foreach($plant->areas as $area)
                                                        <table class="table table-bordered mt-2">
                                                            <thead>
                                                            <tr>
                                                                <th>Area: {{ $area->name }}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#machines-{{ $area->id }}">
                                                                        View Machines
                                                                    </button>
                                                                    <div id="machines-{{ $area->id }}" class="collapse">
                                                                        @foreach($area->machines as $machine)
                                                                            <table class="table table-bordered mt-2">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Machine: {{ $machine->name }}</th>
                                                                                    <th>
                                                                                        <button class="btn btn-primary">Start Diagnosis</button>
                                                                                    </th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <tr>
                                                                                    <td colspan="2">
                                                                                        <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#points-{{ $machine->id }}">
                                                                                            View Machine Points
                                                                                        </button>
                                                                                        <div id="points-{{ $machine->id }}" class="collapse">
                                                                                            <table class="table table-bordered mt-2">
                                                                                                <thead>
                                                                                                <tr>
                                                                                                    <th>Point</th>
                                                                                                    <th>Action</th>
                                                                                                </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                @foreach($machine->machinePoints as $point)
                                                                                                    <tr>
                                                                                                        <td>{{ $point->name }}</td>
                                                                                                        <td>
                                                                                                            <button class="btn btn-primary">Start Diagnosis</button>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                @endforeach
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        @endforeach
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    @endforeach
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
@endsection
