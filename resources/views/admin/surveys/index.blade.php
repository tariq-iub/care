@extends('layouts.app')

@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Surveys</li>
        </ol>
    </nav>

    <h2 class="text-bold text-body-emphasis mb-5">Surveys List</h2>
    <div id="users" data-list='{"valueNames":["title","inspection","engineer","status"],"page":10,"pagination":true}'>
        <div class="row align-items-center justify-content-between g-3 mb-4">
            <div class="col col-auto">
                <div class="search-box">
                    <form class="position-relative">
                        <input class="form-control search-input search" type="search" placeholder="Search users" aria-label="Search" />
                        <span class="fas fa-search search-box-icon"></span>
                    </form>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex align-items-center">
                    <a class="btn btn-primary" href="{{ route('surveys.create') }}">
                        <span class="fas fa-plus me-2"></span>
                        Add survey
                    </a>
                </div>
            </div>
        </div>

        <div class="mx-n4 mx-lg-n6 px-4 px-lg-6 mb-9 bg-body-emphasis border-y mt-2 position-relative top-1">
            <div class="table-responsive scrollbar ms-n1 ps-1">
                <table class="table table-sm fs-9 mt-3">
                    <thead>
                    <tr>
                        <th class="sort align-middle" scope="col" data-sort="title" style="width:30%; min-width:200px;">Title</th>
                        <th class="sort align-middle" scope="col" data-sort="inspection" style="width:30%; min-width:200px;">Inspection</th>
                        <th class="sort align-middle" scope="col" data-sort="engineer" style="width:10%;">Engineer</th>
                        <th class="sort align-middle" scope="col" data-sort="status" style="width:10%;">Status</th>
                        <th class="sort align-middle" scope="col" style="width:10%;">Scheduled at</th>
                        <th class="no-sort align-middle text-end">Action</th>
                    </tr>
                    </thead>
                    <tbody class="list">
                    @foreach($surveys as $row)
                        <tr class="hover-actions-trigger btn-reveal-trigger position-static">
                            <td class="align-middle white-space-nowrap title">
                                <div class="d-flex align-items-center text-body text-hover-1000 ps-2">
                                    <div class="mb-0 ms-3 fw-semibold">
                                        {{ $row->survey_name }}
                                        <div class="text-info small">
                                            {{ $row->survey_type }}
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td class="email align-middle white-space-nowrap visitor_name">
                                <div class="mb-0 ms-3 fw-semibold">
                                    {{ $row->inspection->title }}
                                </div>
                            </td>

                            <td class="role align-middle white-space-nowrap text-body type">
                                <div class="mb-0 ms-3 fw-semibold">
                                    {{ $row->engineer->name }}
                                </div>
                            </td>

                            <td class="align-middle status">
                                {{ $row->status }}

                                <div class="text-info small">
                                    @if($row->taken_up)
                                        <span class="badge badge-phoenix fs-10 badge-phoenix-success">
                                            <span class="badge-label">Taken-Up</span>
                                        </span>
                                    @else
                                        <span class="badge badge-phoenix fs-10 badge-phoenix-warning">
                                            <span class="badge-label">Not Taken-Up</span>
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <td class="align-middle">
                                {{ $row->scheduled_at }}
                            </td>

                            <td class="last_active align-middle text-end white-space-nowrap text-body-tertiary">
                                <div class="btn-reveal-trigger position-static">
                                    <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
                                            type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent">
                                        <span class="fas fa-ellipsis fs-10"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end py-2" style="">
                                        <a class="dropdown-item" href="{{ route('surveys.edit', $row->id) }}">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-id="{{ $row->id }}" data-bs-toggle="modal" data-bs-target="#machineAttachmentModal">Attach Machines</a>
                                        <a class="dropdown-item" href="javascript:void(0)" data-id="{{ $row->id }}" data-bs-toggle="modal" data-bs-target="#machineDetachmentModal">Detach Machines</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="javascript:void(0)">Remove</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Machine Attachment Modal -->
    <div class="modal fade" id="machineAttachmentModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="machineAttachmentLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title" id="machineAttachmentLabel">Machine Attachment</h5>
                    <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fas fa-times fs-9"></span>
                    </button>
                </div>
                <form method="POST" action="{{ route('surveys.survey_machine_attachment') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="survey-id" name="survey_id" value="">
                        <div class="machine-list"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Machine Detachment Modal -->
    <div class="modal fade" id="machineDetachmentModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="machineDetachmentLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header justify-content-between">
                    <h5 class="modal-title" id="machineDetachmentLabel">Machine Detachment</h5>
                    <button class="btn p-1" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span class="fas fa-times fs-9"></span>
                    </button>
                </div>
                <form method="POST" action="{{ route('surveys.survey_machine_detachment') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="detach-survey-id" name="survey_id" value="">
                        <div class="machine-list"></div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Load machine attachment modal
        $('#machineAttachmentModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var surveyId = button.data('id'); // Extract survey ID
            $('#survey-id').val(surveyId); // Set survey ID in the hidden input

            var machineList = $(this).find('.machine-list'); // Target list container

            // Fetch available machines for attachment
            $.get(`{{ url('/api/surveys/attach_machines/${surveyId}') }}`, function (response) {
                $(machineList).html(response.list); // Populate the modal with response
            });
        });

        // Load machine detachment modal
        $('#machineDetachmentModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var surveyId = button.data('id'); // Extract survey ID
            $('#detach-survey-id').val(surveyId); // Set survey ID in the hidden input

            var machineList = $(this).find('.machine-list'); // Target list container

            // Fetch attached machines for detachment
            $.get(`{{ url('/api/surveys/detach_machines/${surveyId}') }}`, function (response) {
                $(machineList).html(response.list); // Populate the modal with response
            });
        });
    </script>
@endpush
