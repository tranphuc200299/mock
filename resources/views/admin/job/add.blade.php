@extends('admin.layouts.admin')

@section('title')
    Create job
@endsection

@section('content')
    @php
        $occupation = get_occupation_by_store();
        $timeMins = get_list_time_15_min();
    @endphp
    <div class="content-wrapper">
        <div class="content">
            <div class="card card-add-job">
                <div class="card-body" style="padding: 1.25rem 3.25rem;">
                    <h3 class="modal-title font-weight-bold mb-4">Create job</h3>
                    <form class="form-job">
                        <div class="form-group">
                            <label class="title-input-custom" for="select-occupation">Select Occupation <span class="text-danger">*</span></label>
                            <select class="form-control" id="select-occupation" name="occupation">
                                @foreach($occupation as $item)
                                    <option value="{{ $item->id }}" @if($item->id == $occupationId) selected @endif>{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="block-datetime">
                            <div class="block-group-datetime">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label class="title-input-custom" for="work-date">Work date <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control datepicker inputMulti" name="time[0][workDate]">
                                        <small style="color: red; display: block" class="error error_time-0-workDate"></small>
                                    </div>
                                    <div class="form-group col-6">
                                        <label class="title-input-custom" for="work-time">Work time (h) <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control timepicker inputMulti working-time" name="time[0][workTime]" readonly>
                                        <small style="color: red; display: block" class="error error_time-0-workTime"></small>
                                    </div>
                                </div>

                                <label class="title-input-custom" for="working-time">Working time <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <select class="form-control working-time-from" name="time[0][workingTimeFrom]">
                                            @foreach($timeMins as $time)
                                                <option value="{{ $time }}">{{ $time }}</option>
                                            @endforeach
                                        </select>
                                        <small style="color: red; display: block" class="error error_time-0-workingTimeFrom"></small>
                                    </div>
                                    <div class="form-group col-6">
                                        <select class="form-control working-time-to" name="time[0][workingTimeTo]">
                                            @foreach($timeMins as $time)
                                                <option value="{{ $time }}">{{ $time }}</option>
                                            @endforeach
                                        </select>
                                        <small style="color: red; display: block" class="error error_time-0-workingTimeTo"></small>
                                    </div>
                                </div>

                                <label class="title-input-custom" for="working-time">Deadline to apply</label>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <input type="text" class="form-control datepicker deadline-date" name="time[0][deadlineDate]">
                                    </div>
                                    <div class="form-group col-6">
                                        <input type="text" class="form-control timepicker deadline-time" name="time[0][deadlineTime]">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn-add-new-block mb-2"><i class="fas fa-plus"></i></button>

                        <div class="row">
                            <div class="form-group col-6">
                                <label class="title-input-custom" for="work-date">Break time (minute)</label>
                                <input type="text" class="form-control" name="breakTime">
                                <small style="color: red; display: block" class="error error_breakTime"></small>
                            </div>
                            <div class="form-group col-6">
                                <label class="title-input-custom" for="work-time">Number of people <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="numberOfPeople">
                                <small style="color: red; display: block" class="error error_numberOfPeople"></small>
                            </div>
                        </div>

                        {{-- salary   --}}
                        <div class="row">
                            <div class="form-group col-6">
                                <label class="title-input-custom" for="work-time">Salary per hours <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="salaryPerHour">
                                <small style="color: red; display: block" class="error error_salaryPerHour"></small>
                            </div>

                            <div class="form-group col-6">
                                <label class="title-input-custom" for="work-time">Travel fees</label>
                                <input type="text" class="form-control" name="travelFees">
                                <small style="color: red; display: block" class="error error_travelFees"></small>
                            </div>
                        </div>

                        {{-- status --}}
                        <div class="row">
                            <div class="form-group col-6 d-flex justify-content-around">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" value="{{ \App\Models\Job::STATUS['HIRING'] }}" checked>Hiring
                                </label>
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" value="{{ \App\Models\Job::STATUS['DISABLE'] }}">Disable
                                </label>
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" value="{{ \App\Models\Job::STATUS['FINISH'] }}">Finish
                                </label>
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="status" value="{{\App\Models\Job::STATUS['CANCEL']}}">Cancel
                                </label>
                            </div>
                        </div>

                        {{-- setting matching --}}
                        <span class="title-input-custom">Recruitment method</span>
                        <div class="row">
                            <div class="form-group col-6 d-flex justify-content-around">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="settingJob" value="0" checked>Applicant selection
                                </label>
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="settingJob" value="1">immediate matching
                                </label>
                            </div>
                        </div>
                        {{-- button --}}
                        <div class="row">
                            <div class="col-12 text-right">
                                <button class="btn btn-cancel">CANCEL</button>
                                <button class="btn btn-save btn-confirm-job ml-3">SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--modal confirm create job --}}
    @include('admin.job.confirm-modal')
@endsection
<script type="text/html" id="html_datetime">
    <div class="block-group-datetime mt-3 position-relative wow fadeInUp">
        <button class="btn-delete-block position-absolute"><i class="far fa-trash-alt"></i></button>
        <div class="row">
            <div class="form-group col-6">
                <label class="title-input-custom" for="work-date">Work date <span class="text-danger">*</span></label>
                <input type="text" class="form-control datepicker inputMulti" name="workDate[]">
                <small style="color: red; display: block" class="error error_workDate"></small>
            </div>
            <div class="form-group col-6">
                <label class="title-input-custom" for="work-time">Work time (h) <span class="text-danger">*</span></label>
                <input type="text" class="form-control timepicker inputMulti working-time" name="workTime[]" readonly>
                <small style="color: red; display: block" class="error error_workTime"></small>
            </div>
        </div>

        <label class="title-input-custom" for="working-time">Working time <span class="text-danger">*</span></label>
        <div class="row">
            <div class="form-group col-6">
                <select class="form-control working-time-from" name="workingTimeFrom[]">
                    @foreach($timeMins as $time)
                        <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
                <small style="color: red; display: block" class="error error_workingTimeFrom"></small>
            </div>
            <div class="form-group col-6">
                <select class="form-control working-time-to" name="workingTimeTo[]">
                    @foreach($timeMins as $time)
                        <option value="{{ $time }}">{{ $time }}</option>
                    @endforeach
                </select>
                <small style="color: red; display: block" class="error error_workingTimeTo"></small>
            </div>
        </div>

        <label class="title-input-custom" for="working-time">Deadline to apply</label>
        <div class="row">
            <div class="form-group col-6">
                <input type="text" class="form-control datepicker deadline-date" name="deadlineDate[]">
            </div>
            <div class="form-group col-6">
                <input type="text" class="form-control timepicker deadline-time" name="deadlineTime[]">
            </div>
        </div>
    </div>
</script>
@push('scripts')
    <script>
        let key_f = 1;
        let data = null;
        $('body').on('focus',".datepicker", function(){
            $(this).datetimepicker({
                // format: 'DD/MM/YYYY',
                format: 'YYYY/MM/DD',
                icons: {
                    time:'fa fa-clock-o',
                    date:'fa fa-calendar',
                    up:'fa fa-chevron-up',
                    down:'fa fa-chevron-down',
                    previous:'fa fa-chevron-left',
                    next:'fa fa-chevron-right',
                    today:'fa fa-crosshairs',
                    clear:'fa fa-trash-o',
                    close:'fa fa-times'
                },
            });
        });
        $('body').on('focus',".timepicker", function(){
            $(this).datetimepicker({
                format: 'HH:mm',
                icons: {
                    time:'fa fa-clock-o',
                    date:'fa fa-calendar',
                    up:'fa fa-chevron-up',
                    down:'fa fa-chevron-down',
                    previous:'fa fa-chevron-left',
                    next:'fa fa-chevron-right',
                    today:'fa fa-crosshairs',
                    clear:'fa fa-trash-o',
                    close:'fa fa-times'
                },
            });
        });
        let key = 0;
        const HTML = $('#html_datetime').html();
        $('body').on('click', '.btn-add-new-block', function(event) {
            event.preventDefault();
            append(HTML);
            key_f++;
        });

        function append(HTML) {
            let block = HTML.replace('workDate[]', `time[${key_f}][workDate]`);
            block = block.replace('error_workDate', `error_time-${key_f}-workDate`);
            block = block.replace('workTime[]', `time[${key_f}][workTime]`);
            block = block.replace('error_workTime', `error_time-${key_f}-workTime`);

            block = block.replace('workingTimeFrom[]', `time[${key_f}][workingTimeFrom]`);
            block = block.replace('error_workingTimeFrom', `error_time-${key_f}-workingTimeFrom`);

            block = block.replace('workingTimeTo[]', `time[${key_f}][workingTimeTo]`);
            block = block.replace('error_workingTimeTo', `error_time-${key_f}-workingTimeTo`);

            block = block.replace('deadlineDate[]', `time[${key_f}][deadlineDate]`);
            block = block.replace('deadlineTime[]', `time[${key_f}][deadlineTime]`);

            $('#block-datetime').append(block);
        }

        $('body').on('click', '.btn-delete-block', function () {
            $(this).parents('.block-group-datetime').remove();
        });

        $('body').on( "click",".btn-confirm-job", function(event) {
            event.preventDefault();
            $(".form-job").find('.error').hide();
            let form = $(this).parents('.form-job');
            let formData = new FormData(form.get(0));
            $.ajax({
                url: URL_JOB_CONFIRM,
                type:"POST",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    form.find('.btn-save').html('<i class="fas fa-spinner fa-pulse" style="font-size: 24px"></i>');
                    form.find('.btn-save').prop('disabled', true);
                },
                success:function(res){
                    if(res.status == 400){
                        form.find('.btn-save').prop('disabled', false);
                        form.find('.btn-save').html('SAVE');
                        $.each(res.errors, function (key, value) {
                            key = key.replace(/[.]/gi,"-");
                            if (value != null) {
                                $(".error_" + key).html(value);
                                $(".error_" + key).show();
                            }
                        });
                    }else {
                        data = res;
                        setTimeout(function() {
                            confirmJob();
                            form.find('.btn-save').prop('disabled', false);
                            form.find('.btn-save').html('SAVE');
                        }, 1000);
                    }
                },error:function(error){
                    form.find('.btn-save').prop('disabled', false);
                    form.find('.btn-save').html('SAVE');
                    let errors = error.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        key = key.replace(/[.]/gi,"-");
                        if (value != null) {
                            $(".error_" + key).html(value[0]);
                            $(".error_" + key).show();
                        }
                    });

                }
            }); //end of ajax
        });

        function confirmJob(){
            let html = $('#model_confirm_job');
            $('#model_confirm_job').modal('show');
            html.find('.detail-title').html(data.occupation.title);
            html.find('.detail-description').html(data.occupation.description);
            html.find('.detail-work-address').html(data.occupation.work_address);
            html.find('.detail-access-address').html(data.occupation.access_address);
            let status = '';
            let statusStyle = '';
            if (data.job.status == {{ \App\Models\Job::STATUS['DISABLE'] }}) {
                status = 'Disable';
                statusStyle = 'background: #e0e0e4';
            }else if (data.job.status == {{ \App\Models\Job::STATUS['HIRING'] }}){
                status = 'Hiring';
                statusStyle = 'background: #f1cea5';
            }else if(data.job.status == {{ \App\Models\Job::STATUS['CANCEL'] }}){
                status = 'Cancel';
                statusStyle = 'background: #e0e0e4';
            }else{
                status = 'Finish';
            }
            html.find('.detail-status').html(status);
            html.find('.detail-status').attr("style", statusStyle);
            html.find('.detail-break-time').html(data.job.breakTime + ' minute');
            html.find('.detail-people').html(data.job.numberOfPeople);
            html.find('.detail-salary-hours').html(data.job.salaryPerHour + '$');
            html.find('.detail-travel-fees').html((data.job.travelFees ?? 0) + '$');

            $('.block-view-image ').empty();
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

            //create date format
            let timeStart = new Date("01/01/2007 " + data.job.time[0]['workingTimeFrom']).getHours();
            let timeEnd = new Date("01/01/2007 " + data.job.time[0]['workingTimeTo']).getHours();
            let hourDiff = timeEnd - timeStart;
            let totalAmount = Number(data.job.salaryPerHour) * hourDiff + Number(data.job.travelFees);
            html.find('.detail-total-amount').html(totalAmount + '$');

            let deadline = '';
            let deadlineDate = data.job.time[0]['deadlineDate'];
            let deadlineTime = data.job.time[0]['deadlineTime'];
            deadlineDate = deadlineDate ?? '';
            deadlineTime = deadlineTime ?? '';
            deadline += deadlineDate + ' '+ deadlineTime;
            console.log(deadlineDate);
            html.find('.detail-deadline').html(deadline);

            let workTime = '';
            $.each( data.job.time, function( key, value ) {
                workTime += value.workDate + ' ' + value.workingTimeFrom + '~' + value.workingTimeTo +'<br>';
            });
            html.find('.detail-work-time').html(workTime);
        }


        $('body').on('click', '#btn-add-update-job', function(event){
            event.preventDefault();
            let formData = new FormData($('.form-job').get(0));
            $.ajax({
                url: '{{ route("job.store") }}',
                type:"POST",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btn-add-update-job').html('<i class="fas fa-spinner fa-pulse" style="font-size: 24px"></i>');
                    $('#btn-add-update-job').prop('disabled', true);
                },
                success:function(data){
                    $('#btn-add-update-job').html('SAVE');
                    $('#btn-add-update-job').prop('disabled', false);
                    toastr.success('Create job successful');
                    setTimeout(function() {
                        let url = '{{ route("job.edit", ":id") }}';
                        url = url.replace(':id', data.job.id);
                        window.location.href = url;
                    }, 1500);
                    console.log(data);
                },error:function(error){
                    $('#btn-add-update-job').html('SAVE');
                    $('#btn-add-update-job').prop('disabled', false);
                    console.log(error);
                }
            }); //end of ajax
        });

        $('body').on('change', '.working-time-to', function(){
            let time2 = $(this).val();
            let time1 = $(this).parents('.row').find('.working-time-from').val();
            let result = minsToStr( strToMins(time2) - strToMins(time1) );
            $(this).parents('.block-group-datetime').find('.working-time').val(result);
        });

        $('body').on('change', '.working-time-from', function(){
            let time1 = $(this).val();
            let time2 = $(this).parents('.row').find('.working-time-to').val();
            let result = minsToStr( strToMins(time2) - strToMins(time1) );
            $(this).parents('.block-group-datetime').find('.working-time').val(result);
        });

        function strToMins(t) {
            let s = t.split(":");
            return Number(s[0]) * 60 + Number(s[1]);
        }

        function minsToStr(t) {
            return Math.trunc(t / 60)+':'+('00' + t % 60).slice(-2);
        }

    </script>
@endpush

