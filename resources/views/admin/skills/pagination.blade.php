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

                                    <button class="btn-edit"><i class="fas fa-pen"></i></button>
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
