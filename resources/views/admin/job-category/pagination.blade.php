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
                @if (count($category) <= 0)
                    <tr class="odd wow fadeInUp">
                        <td colspan="2">No data.</td>
                    </tr>
                @else
                    @foreach ($category as $Key => $categories)
                        <tr class="odd">
                            <td class="dtr-control sorting_1" tabindex="0">{{ $categories->id }}</td>
                            <td> {{ $categories->name }}</td>
                            <td> {{ $categories->description }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a
                                        href="{{ route('categoryjob.edit', [$categories->id, $categories->parent_id]) }}">
                                        <button class="btn-edit"><i class="fas fa-pen"></i></button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-md-5">
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers">
            {!! $category->links() !!}
        </div>
    </div>
</div>
