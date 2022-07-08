@foreach($fileUpload as $file)
    <a class="dropdown-item" href="{{ URL::asset($file->path) }}" download>
        {{ $file->title }}</a>
@endforeach
