<div class="input-group input-group-sm mb-3">
    <span class="input-group-text" id="search_label">Search</span>
    <input class="form-control" type="text" id="search_machine" aria-label="Search Machines" aria-describedby="search_label">
</div>

@forelse($machines as $machine)
    <div class="form-check machine-item">
        <input class="form-check-input" type="checkbox" id="check{{ $machine->id }}" name="machine_ids[]" value="{{ $machine->id }}">
        <label class="form-check-label" for="check{{ $machine->id }}">{{ $machine->name }}</label>
    </div>
@empty
    <p class="text-danger">No machines available for attachment.</p>
@endforelse

<script>
    var search = document.getElementById('search_machine');
    var machineItems = document.querySelectorAll('.machine-item');

    search.addEventListener('keyup', function () {
        var query = search.value.toLowerCase();
        machineItems.forEach(function (item) {
            var label = item.querySelector('label').textContent.toLowerCase();
            if (label.includes(query)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>
