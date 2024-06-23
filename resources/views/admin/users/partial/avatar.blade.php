@if($row->avatar)
    <img class="rounded img-fluid avatar-40" src="{{ asset($row->avatar) }}" alt="avatar"
         data-toggle="tooltip" data-placement="top" title="{{ $row->name }}">
@else
    <img class="rounded img-fluid avatar-40" src="{{ asset('assets/images/user/user.png') }}" alt="avatar"
         data-toggle="tooltip" data-placement="top" title="{{ $row->name }}">
@endif
