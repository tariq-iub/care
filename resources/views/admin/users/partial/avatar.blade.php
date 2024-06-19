@if($row->avatar)
    <img class="rounded img-fluid avatar-40" src="{{ asset($row->avatar) }}" alt="avatar">
@else
    <img class="rounded img-fluid avatar-40" src="{{ asset('assets/images/user/user.png') }}" alt="avatar">
@endif
