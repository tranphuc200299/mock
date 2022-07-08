<table class="table table-bordered">
    <thead class="thead-light">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Contact infor</th>
        <th>Point</th>
        <th>Invitation code</th>
        <th>Status</th>
        <th>Created date</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($workers) && $workers->count())
        @foreach($workers as $worker)
            <tr class="wow fadeInUp @if($worker->profile->status == \App\Models\WorkerProfile::STATUS['DEACTIVED'] ||
                                        $worker->profile->status == \App\Models\WorkerProfile::STATUS['NOT-SETTING-PROFILE']) bg-gray-table
                                        @elseif($worker->profile->status == \App\Models\WorkerProfile::STATUS['PENDING-APPROVE']) bg-pink-table
                                        @endif">
                <td>{{ $worker->id }}</td>
                <td>{{ $worker->profile->first_name .' '. $worker->profile->last_name }}</td>
                <td>
                    <p>Email:{{ $worker->email }}</p>
                    <p>Phone:{{ $worker->phone }}</p>
                </td>
                <td>{{ $worker->point }}</td>
                <td>{{ $worker->invitation_code }}</td>
                <td>{{ \App\Models\WorkerProfile::getStatus($worker->profile->status) }}</td>
                <td>{{ $worker->created_at }}</td>
                <td>
                    <button class="btn btn-view btn-worker-detail" data-toggle="modal" data-target="#editWorker"
                            data-id="{{ $worker->id }}"><i class="far fa-eye"></i></button>
                    <button class="btn btn-delete ml-2 btn-delete-worker" data-toggle="modal"
                            data-target="#modal_confirm_delete_worker" data-id="{{ $worker->id }}">
                        <i class="far fa-trash-alt"></i></button>
                </td>
            </tr>
        @endforeach
    @else
        <tr class="odd wow fadeInUp">
            <td colspan="6">No data.</td>
        </tr>
    @endif
    </tbody>
</table>
{{-- Pagination --}}
<div class="row">
    <div class="col-sm-12 col-md-5">
    </div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="company-paginate">
            {!! $workers->links() !!}
        </div>
    </div>
</div>

