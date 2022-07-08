@extends('admin.layouts.admin')
@section('title')
    Skills
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content">
            @if (Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                    {{ Session::get('message') }}
                </p>
            @endif
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 p-3">
                <div class="d-flex justify-content-between mb-3">
                    <h3 class="d-inline-block">List skills</h3>
                    <a href="{{ route('skill.create') }}" id="skills-create" class="btn-add-new">
                        <i class="fas fa-plus"></i></a>
                </div>
                <div id="list-skill">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="example2" class="table table-bordered" role="grid" aria-describedby="example2_info">
                                <thead class="thead-light">
                                    <tr role="row">
                                        <th class="sorting sorting_asc">ID</th>
                                        <th class="sorting"> Name</th>
                                        <th class="sorting">Description</th>
                                        <th class="sorting"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($skills as $Key => $skill)
                                        <tr class="odd">
                                            <td class="dtr-control sorting_1" tabindex="0">{{ $skill->id }}</td>
                                            <td> {{ $skill->name }}</td>
                                            <td> {{ $skill->description }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('skill.edit', [$skill->id]) }}">

                                                        <button class="btn-edit">
                                                            <i class="fas fa-pen"></i></button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div>
                                {{ $skills->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
    <script>
        $("document").ready(function() {
            $(".alert-success").delay(2000).fadeOut(3000);
        });
    </script>
@endpush
<!----->
@push('scripts')
    <script>
        // event click pagination category
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        // fetch data pagination company
        function fetch_data(page) {
            $.ajax({
                url: URL_SKILL_INDEX + "?page=" + page,
                method: "GET",
                success: function(data) {
                    $("#list-skill").html(data.body);
                }
            });
        }
    </script>
@endpush
