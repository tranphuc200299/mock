<table class="table table-bordered">
    <thead class="thead-light">
    <tr>
        <th>Status</th>
        <th>Worke time</th>
        <th>Title job</th>
        <th>Number of people</th>
        <th>Applied people</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @if(!empty($jobs) && $jobs->count())
        @foreach($jobs as $job)
            <tr class="wow fadeInUp @if($job->status == \App\Models\Job::STATUS['DISABLE'] ||
                                        $job->status == \App\Models\Job::STATUS['CANCEL']) bg-gray-table
                                        @elseif($job->status == \App\Models\Job::STATUS['FINISH']) bg-yellow-table
                                        @endif">
                <td>{{ \App\Models\Job::getStatus($job->status) }}</td>
                <td>{{ $job->work_date }}</td>
                <td>{{ $job->occupation->title }}</td>
                <td>{{ $job->required_number_of_person }}</td>
                <td>2</td>
                <td>
                    <button class="btn btn-view btn-job-detail" data-toggle="modal" data-target="#model_view_detail_job"
                            data-id="{{ $job->id }}"><i class="far fa-eye"></i></button>
                    <form action="{{ route('job.duplicate') }}" method="post" class="d-inline-block">
                        @csrf
                        <input type="hidden" value="{{ $job->id }}" name="id">
                        <button class="btn btn-duplicate"><i class="far fa-clone"></i></button>
                    </form>
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
            {!! $jobs->links() !!}
        </div>
    </div>
</div>
