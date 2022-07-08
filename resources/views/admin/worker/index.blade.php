@extends('admin.layouts.admin')

@section('title')
    List worker
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="content py-2">
            <div class="d-flex mb-3 px-2">
                <h3 class="d-inline-block">List worker</h3>
            </div>
            <div class="main-content">
                <div class="row">
                    <div class="form-group col-sm-4">
                        <input class="form-control" type="text" name="keyword" id="searchWorker" placeholder="Search by keyword">
                    </div>
                    <div class="col-sm-4 d-flex">
                        <div class="form-check form-check-custom">
                            <label class="form-check-label">
                                <input class="form-check-input" name="searchStatus[]" type="checkbox"
                                       value="1"> Enable
                            </label>
                        </div>
                        <div class="form-check form-check-custom">
                            <label class="form-check-label">
                                <input class="form-check-input" name="searchStatus[]" type="checkbox"
                                       value="0"> Disable
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4 text-right">
{{--                        <a href="{{ route('job.create') }}" class="btn-add-new"><i class="fas fa-plus"></i></a>--}}
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6">
                        <span class="mr-2">Registed date</span>
                        <input type="text" class="input-date-filter datepicker" name="date_start">
                        <span>~</span>
                        <input type="text" class="input-date-filter datepicker" name="date_end">
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-4">
                    </div>
                </div>
                <div class="d-flex mb-2">
                    <span id="total-worker">Total: {{ $workers->total() }}</span>
                    <span class="ml-5">Total workers registered in today: {{ $workers->total() }}</span>
                </div>
                <div id="list-workers">
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
                                        @elseif($worker->profile->status == \App\Models\WorkerProfile::STATUS['PENDING-APPROVE']) bg-yellow-table
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
                </div>
            </div>
        </div>
    </div>

    {{-- modal comfirm delete worker--}}
    @include('admin.worker.popup-confirm-delete-worker')
    @include('admin.modal.worker.editWorker')
    @include('admin.modal.worker.popup-confirm-reject-worker')
@endsection
@push('scripts')
    <script>
        $('body').on('click','.btn-worker-detail', function (event) {
            let id = $(this).data('id');
            let url = '{{ route("admin.worker.show", ":id") }}';
            url = url.replace(':id', id);
            // $('.btn-edit-job').attr('href', url);
            $.ajax({
                url: url,
                type:"GET",
                success:function(data) {
                    let worker = data.worker;
                    let profile = data.profile;
                    let images = data.images;
                    let html = $('#editWorker');
                    html.find('#idWorker').val(id);
                    html.find('.worker_name').html((profile.first_name ?? '')+' '+( profile.last_name ?? ''));

                    if (worker.verify_email) {
                        html.find('#worker_status_enable').prop("checked", true);
                    } else {
                        html.find('#worker_status_disable').prop("checked", true);
                    }

                    for(let i=0; i < images.length; i++) {
                        html.find('.degree-image').append(
                            '<div class="col-3">'+
                            '<img class="certificate__image" src="{{ asset('') }}'+ images[i].path +'"/>'+
                            '</div>'
                        );
                    }

                    if (profile.status == '0') {
                        html.find('.approve_passport').css("display", 'none');
                    } else {
                        html.find('.approve_passport').css("display", 'block');
                    }

                    html.find('.input__worker__name').val((profile.first_name ?? '')+' '+( profile.last_name ?? ''));
                    html.find('.input__worker__kana__name').val((profile.furigana_first_name ?? '')+' '+(profile.furigana_last_name ?? ''));

                    if (profile.gender == 1) {
                        html.find('#male').prop("checked", true);
                    } else if (profile.gender == 2){
                        html.find('#female').prop("checked", true);
                    } else {
                        html.find('#other').prop("checked", true);
                    }

                    html.find('.input__worker__birthday').val(profile.birthday);

                    $('#worker-area').empty();
                    if(profile.area) {
                        $('#worker-area').html($('<option>', {
                            value: profile.area,
                            text:  profile.area,
                            selected: "selected"
                        }));
                    }


                    html.find('.input__worker__email').val(worker.email);
                    html.find('.input__worker__phone').val(worker.phone);

                    if (worker.line_id == null) {
                        html.find('#phone').prop("checked", true);
                    } else{
                        html.find('#line').prop("checked", true);
                    }

                    if (profile.status == {{\App\Models\WorkerProfile::STATUS['ACTIVED']}}) {
                        html.find('#approved').prop("checked", true);
                    } else if (profile.status == {{\App\Models\WorkerProfile::STATUS['PENDING-APPROVE']}}) {
                        html.find('#waiting_approve').prop("checked", true);
                    } else {
                        html.find('#not_upload').prop("checked", true);
                    }

                    html.find('.passport__image__front').attr("src", profile.passport_image_front);
                    html.find('.passport__image__back').attr("src", profile.passport_image_back);
                    html.find('.view-detail-img').attr("src","{{ asset('') }}"+ profile.profile_image);
                    if(profile.status == 0) {
                        html.find('.approve_passport').css("display", "none");
                    }

                },error:function(){
                    console.log('error');
                }
            }); //end of ajax
        });
        // fetch data pagination worker
        function fetch_data(page) {
            let keyword = $('#searchWorker').val();
            $.ajax({
                url: URL_WORKER_SEARCH_PAGINATION + "?page=" + page,
                data: {
                    'keyword':keyword },
                success: function(data) {
                    $("#list-workers").html(data.body);
                }
            });
        }

        // event keyup live search workers
        $('#searchWorker').on('keyup', function(){
            searchWorker();
        });
        $("input[name='searchStatus[]']").on('change', function(){
            searchWorker();
        });

        $('.datepicker').on('dp.hide', function(e){
            searchWorker();
        });

        // function search workers
        function searchWorker() {
            let keyword = $('#searchWorker').val();
            let checked = [];
            let dateStart = $("input[name='date_start']").val();
            let dateEnd = $("input[name='date_end']").val();
            $("input[name='searchStatus[]']:checked").each(function ()
            {
                checked.push(parseInt($(this).val()));
            });
            $.ajax({
                url: URL_WORKER_SEARCH_PAGINATION,
                type:"GET",
                data: {
                    'keyword':keyword,
                    'status' :checked,
                    'date_start': dateStart,
                    'date_end': dateEnd,
                },
                success:function(data){
                    $("#list-workers").html(data.body);
                },error:function(){
                    console.log('error');
                }
            }); //end of ajax
        }

        $('body').on('click', '.btn-delete-worker', function () {
            let id = $(this).data('id');
            $('#input-confirm-worker-id').val(id);
        });

        $('#btn-confirm-reject-worker').on('click', function() {
            let id = $('#idWorker').val();
            let url = '{{ route("admin.worker.rejectProfile", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "POST",
                success:function(data){
                    fetch_data();
                    $('#modal_confirm_reject_worker').modal('hide');
                    $('#editWorker').modal('hide');
                    toastr.success('reject worker success');
                },error:function(error){
                    console.log(error);
                }
            });
        });

        $(document).on('click','#btn-confirm-delete-worker',function(event) {
            let id = $('#input-confirm-worker-id').val();
            $("#btn-confirm-delete-worker").attr( "disabled", "disabled" );
            $.ajax({
                url: '{{ route('delete.worker') }}',
                type:"POST",
                data:{
                    id
                },
                beforeSend: function() {
                    $('#btn-confirm-delete-worker').html('<i class="fas fa-spinner fa-pulse"></i>');
                },
                success:function(data){
                    setTimeout(function() {
                        $("#btn-confirm-delete-worker").removeAttr("disabled");
                        $('#btn-confirm-delete-worker').html('Delete');
                        $('#modal_confirm_delete_worker').modal('hide');
                        toastr.success(data.message);
                        searchWorker();
                    }, 1000);
                },error:function(error){
                    $("#btn-confirm-delete-worker").removeAttr("disabled");
                    $('#btn-confirm-delete-worker').html('Delete');
                    toastr.error(error);
                    console.log(error);
                }
            }); //end of ajax
        });
    </script>
@endpush

