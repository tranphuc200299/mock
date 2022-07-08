

<div class="row">
    <div class="col-sm-12 wow fadeInUp">
        <table id="table-list-company" class="table table-bordered" role="grid" aria-describedby="example2_info">
            <thead class="thead-light">
            <tr role="row">
                <th class="sorting sorting_asc">ID</th>
                <th class="sorting" >Store name</th>
                <th class="sorting" >Person in change</th>
                <th class="sorting" >Address</th>
                <th class="sorting" >Status</th>
                <th class="sorting" >Created date</th>
                <th class="sorting" ></th>
            </tr>
            </thead>
            <tbody>
            @foreach($store as $item)
                <tr class="odd">
                    <td class="dtr-control sorting_1" tabindex="0">{{ $item->id }}</td>
                    <td>{{ $item->store_name }}</td>
                    <td>
                        Name: {{ $item->person_in_charge_name }}
                        <br>
                        Phone: {{ $item->person_in_charge_phone_number }}
                        <br>
                        Email: {{ $item->person_in_charge_email }}
                    </td>
                    <td>{{ $item->address }}</td>
                    <td>
                        @if($item->status)
                            Enable
                        @else
                            Disable
                        @endif
                    </td>
                    <td>
                        {{ $item->created_at  }}
                    </td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-edit" href="{{ route('store.edit', [$item->id]) }}">
                                <i class="fas fa-pen"></i></a>
                            <button class="btn btn-delete ml-2" data-toggle="modal"
                                    data-target="#modal_cannot_delete">
                                <i class="far fa-trash-alt"></i></button>
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
        <div class="dataTables_paginate paging_simple_numbers" id="company-paginate">
            {!! $store->links() !!}
        </div>
    </div>
</div>
