@extends('layouts.care')
@section('title', 'Factories')
@section('page-title', 'Factories')
@section('page-message', "Register and manage factories data.")

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="iq-card">
                <div class="iq-card-header d-flex justify-content-between">
                    <div class="iq-header-title">
                        <h4 class="card-title">Registered Factories</h4>
                    </div>
                    <a href="{{ route('factories.create') }}" class="btn btn-outline-primary">
                        <i class="ri-add-circle-line"></i>Add Factory
                    </a>
                </div>
                <div class="iq-card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-hover table-bordered mt-4" style="width:100%">
                            <thead>
                            <tr>
                                <th>Factory Name</th>
                                <th>Owner Name</th>
                                <th>Contact Info</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($factories as $factory)
                            <tr>
                                <td>
                                    {{ $factory->title }}<br>
                                    <span class="p-1 font-size-10">
                                        {{ $factory->address }}
                                    </span>
                                </td>
                                <td>
                                    {{ $factory->owner_name }}<br>
                                    <span class="p-1 font-size-10">{{ $factory->owner_cnic }}</span>
                                </td>
                                <td>
                                    {{ $factory->email }}<br>
                                    <span class="p-1 font-size-10">{{ $factory->contact_no }}</span>
                                    @if($factory->fax)
                                    <br><span class="p-1 font-size-10">{{ $factory->fax }}</span>
                                    @endif
                                </td>
                                <td class="list-user-action">
                                    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="Edit"
                                       href="{{ route('factories.edit', $factory->id) }}"><i class="ri-pencil-line"></i>
                                    </a>
                                    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="Attach Users"
                                       href="javascript:void(0)"><i class="ri-group-line"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
