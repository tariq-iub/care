<div class="d-flex align-items-center list-user-action">
    <a class="iq-bg-primary" data-toggle="tooltip" data-placement="top" title="Edit"
       href="{{ route('users.edit', $row->id) }}"><i class="ri-pencil-line"></i>
    </a>
    @if($row->status)
    <a class="iq-bg-danger" data-toggle="tooltip" data-placement="top" title="Block"
       href="{{ route('users.status', $row->id) }}"><i class="ri-user-forbid-line"></i>
    </a>
    @else
    <a class="iq-bg-success" data-toggle="tooltip" data-placement="top" title="Unblock"
       href="{{ route('users.status', $row->id) }}"><i class="ri-user-follow-line"></i>
    </a>
    @endif
</div>
