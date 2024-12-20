<div class="btn-reveal-trigger position-static">
    <button class="btn btn-sm dropdown-toggle dropdown-caret-none transition-none btn-reveal fs-10"
            type="button" data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"
            data-bs-reference="parent">

        <span class="fas fa-ellipsis fs-10"></span>
    </button>

    <div class="dropdown-menu dropdown-menu-end py-2" style="">
        <a class="dropdown-item" href="{{ route('data.download', $row->id) }}">Download</a>

        <a class="dropdown-item" href="{{ route('data.edit', $row->id) }}">Edit</a>

        <a class="dropdown-item" href="javascript:void(0)" onclick="OpenReplaceModal({{ $row->id }})">Replace</a>

        <a class="dropdown-item text-danger" href="javascript:void(0)"
           onclick="deleteFile(this, {{ $row->id }})">Delete</a>
    </div>
</div>
