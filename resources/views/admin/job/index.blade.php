@extends('admin.layouts.admin')

@section('title')
    List jobs
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content py-2">
            <div class="d-flex mb-3 px-2">
                <h3 class="d-inline-block">List jobs</h3>
            </div>
            <div class="main-content">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <input class="form-control" type="text" name="keyword" id="searchJob" placeholder="Search by keyword">
                    </div>
                    <div class="col-sm-4 d-flex">
                        <div class="form-check form-check-custom">
                            <label class="form-check-label">
                                <input class="form-check-input" name="searchStatus[]" type="checkbox"
                                       value="{{ \App\Models\Job::STATUS['HIRING'] }}"> Hiring
                            </label>
                        </div>
                        <div class="form-check form-check-custom">
                            <label class="form-check-label">
                                <input class="form-check-input" name="searchStatus[]" type="checkbox"
                                       value="{{ \App\Models\Job::STATUS['DISABLE'] }}"> Disable
                            </label>
                        </div>
                        <div class="form-check form-check-custom">
                            <label class="form-check-label">
                                <input class="form-check-input" name="searchStatus[]" type="checkbox"
                                       value="{{ \App\Models\Job::STATUS['FINISH'] }}"> Finished
                            </label>
                        </div>
                        <div class="form-check form-check-custom">
                            <label class="form-check-label">
                                <input class="form-check-input" name="searchStatus[]" type="checkbox"
                                       value="{{ \App\Models\Job::STATUS['CANCEL'] }}"> Cancelled
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
                        <a href="{{ route('job.create') }}" class="btn-add-new"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span id="total-company">Total: {{ $jobs->total() }}</span>
                </div>
                <div id="list-jobs">
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
                    <div class="row wow fadeInLeft">
                        <div class="col-sm-12 col-md-5">

                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="company-paginate">
                                {!! $jobs->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- modal view detail job --}}
    @include('admin.job.view-detail-job')
@endsection
@push('scripts')
    <script>
        // fetch data pagination company
        function fetch_data(page) {
            let keyword = $('#searchJob').val();
            $.ajax({
                url: URL_JOB_SEARCH_PAGINATION + "?page=" + page,
                data: {
                    'keyword':keyword },
                success: function(data) {
                    $("#list-jobs").html(data.body);
                }
            });
        }

        $('body').on('click','.btn-job-detail', function (event) {
            let id = $(this).data('id');
            let url = '{{ route("job.edit", ":id") }}';
            url = url.replace(':id', id);
            console.log(url);
            $('.btn-edit-job').attr('href', url);

            $.ajax({
                url: URL_JOB_DETAIL,
                type:"GET",
                data: { id },
                success:function(data) {
                    let job = data.job;
                    let status = '';
                    let statusStyle = '';
                    if (job.status == {{ \App\Models\Job::STATUS['DISABLE'] }}) {
                        status = 'Disable';
                        statusStyle = 'background: #e0e0e4';
                    }else if (job.status == {{ \App\Models\Job::STATUS['HIRING'] }}){
                        status = 'Hiring';
                        statusStyle = 'background: #f1cea5';
                    }else if(job.status == {{ \App\Models\Job::STATUS['CANCEL'] }}){
                        status = 'Cancel';
                        statusStyle = 'background: #e0e0e4';
                    }else{
                        status = 'Finish';
                    }
                    let html = $('#model_view_detail_job');
                    html.find('input[name="id"]').val(id);
                    html.find('.detail-status').html(status);
                    html.find('.detail-status').attr("style", statusStyle);
                    html.find('.detail-title').html(job.occupation.title);
                    let workTime = job.work_date +' '+ job.work_time_from.substr(0, 5) + '~'+ job.work_time_to.substr(0, 5);
                    let workingTime = `(break time ${job.break_time} minute)`;
                    html.find('.detail-work-time').html(workTime +' '+workingTime);
                    html.find('.detail-deadline').html(job.deadline_for_apply);
                    $('.block-view-image').empty()
                    $.each( data.images, function (index, value) {
                        if(value != '') {
                            $('.block-view-image ').append(
                                '<div class="col-4 mb-2">'+
                                '<div class="wrap-detail-img">'+
                                '<img class="view-detail-img" src="{{ asset('') }}'+ value.path + '" alt="Image"/>'+
                                '</div>'+
                                '</div>'
                            );
                        }
                    })
                    html.find('.detail-people').html(job.required_number_of_person);
                    html.find('.detail-salary-hours').html(job.salary_per_hour + '$');
                    html.find('.detail-travel-fees').html(job.travel_fees + '$');
                    html.find('.detail-description').html(job.occupation.description);
                    html.find('.detail-work-address').html(job.occupation.work_address);
                    html.find('.detail-access-address').html(job.occupation.access_address);
                    //create date format
                    let timeStart = new Date("01/01/2007 " + job.work_time_from).getHours();
                    let timeEnd = new Date("01/01/2007 " + job.work_time_to).getHours();
                    let hourDiff = timeEnd - timeStart;
                    let totalAmount = job.salary_per_hour * hourDiff + Number(job.travel_fees);
                    html.find('.detail-total-amount').html(totalAmount + '$');

                    console.log(job);
                },error:function(){
                    console.log('error');
                }
            }); //end of ajax
        });

        // event keyup live search jobs
        $('#searchJob').on('keyup', function(){
            searchJob();
        });
        $("input[name='searchStatus[]']").on('change', function(){
            searchJob();
        });

        // function search job
        function searchJob() {
            let keyword = $('#searchJob').val();
            let checked = []
            $("input[name='searchStatus[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
            console.log(checked);
            $.ajax({
                url: URL_JOB_SEARCH_PAGINATION,
                type:"GET",
                data: {
                    'keyword':keyword,
                    'status' :checked
                },
                success:function(data){
                    $("#list-jobs").html(data.body);
                    console.log(data);
                },error:function(){
                    console.log('error');
                }
            }); //end of ajax
        }
    </script>
@endpush

