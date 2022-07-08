@extends('admin.occupation.form')
@section('form')
    <form method="post" enctype="multipart/form-data" id="form-create-occupation">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-md-12 col-xs-12">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Select job category <span style="color: red">*</span></label>
                    <select class="form-control select2_init" name="category_id"
                            id="category_id">
                        <option value="">Chọn danh mục</option>
                        {!!$htmlOption!!}
                    </select>
                    <small style="color: red" class="error error_category_id"></small>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <label for="occupation_title">Occupation title <span style="color: red">*</span></label>
                    <input type="text" value="{{ old('title') ?? $occupation->title ?? '' }}"
                           name="title" class="form-control">
                    <small style="color: red" class="error error_title"></small>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <label for="desciption">Desciption <span style="color: red">*</span></label>
                    <textarea id="descriptionOccupation" class="form-control " cols="100"
                              name="description">{{ old('description') ?? $occupation->description ?? '' }}</textarea>
                    <small style="color: red" class="error error_description"></small>
                </div>
            </div>
            <div class="col-lg-12 col-md-6 col-xs-6">
                <div class="form-group">
                    <label class="Station">Station</label>
                    <select class="form-control station-select2" name="station[]"
                            multiple="multiple" id="station"
                            placeholder="station">
                        @foreach($routes as $route)
                            <option value="{{ $route->id }}"
                                    @if(old('station'))
                                        @for( $i =0; $i < count(old('station')); $i++)
                                            @if($route->id == old('station.'.$i) )
                                                {{ 'selected' }}
                                            @endif
                                        @endfor
                                    @elseif(isset($occupation))
                                        @foreach($occupation->OccupationStation as $item)
                                            @if($route->id == $item->id) )
                                                {{ 'selected' }}
                                            @endif
                                        @endforeach
                                     @endif
                            >{{ $route->getStationByRoute($route->parent_id)->name }}/{{ $route->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <label for="work_address">Work address <span style="color: red">*</span></label>
                    <input type="text"
                           value="{{ old('work_address') ?? $occupation->work_address ?? '' }}"
                           name="work_address" class="form-control">
                    <small style="color: red" class="error error_work_address"></small>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <label for="access_address">Acess address</label>
                    <textarea id="acessAddress"
                              class="form-control " cols="100"
                              name="access_address" data-parsley-trigger="keyup">{{ old('access_address') ?? $occupation->access_address ?? '' }}</textarea>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <label for="photos">Photos ( please upload at least 3 photos with ratio is
                    16:9)</label> <span style="color: red">*</span><br>
                <div class="images row">
                    @for ($i = 0; $i < count(get_image_occupation_by_id($occupation->id)); $i++)
                        <div class="image-item col-3">
                            <div class="image-show-item">
                                <img id="imageEdit{{$i}}" src="{{ asset(get_image_occupation_by_id($occupation->id)[$i]->path) }}"
                                     data-image="{{ get_image_occupation_by_id($occupation->id)[$i]->id }}">
                            </div>
                            <div class="delete-image" data-remove="{{ $i }}">
                                <i class="fas fa-solid fa-trash" ></i>
                            </div>
                        </div>
                        <script>
                            var imageEditCount = '{{ $i }}';
                        </script>
                    @endfor
                </div>
                <small style="color: red" class="error error_count_image"></small>
            </div>
            <div class="image-about">
                <div class="upload-btn-wrapper-image">
                    <input type="hidden" name="id" value="2">
                    <input type="file" name="image_path[]" id="input-image"
                           {{--                                                   onchange="imagesPreview()"--}}
                           accept="image/png,image/jpeg">
                    <label class="btn btn-upload" for="input-image"><i
                            class="fas fa-upload"></i></label>
                    <p id="num-of-files"></p>
                </div>
                <div class="form-control remoteImage" style="border: none">
                    <a class="btn-remote-image mt-4">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
        <small style="color: red" class="error error_file"></small>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label class="speciality">Speciality <span style="color: red">*</span> </label>
                <select class="form-control speciality-select2" name="speciality[]"
                        multiple="multiple" id="speciality"
                        placeholder="speciality">
                    <optgroup label="Group Name">
                        @foreach(\App\Librarys\SPECIALITY as $key => $value)
                            <option value="{{$key}}"
                                @if(old('speciality'))
                                    @for( $i =0; $i < count(old('speciality')); $i++)
                                        @if($key == old('speciality.'.$i) )
                                            {{ 'selected' }}
                                        @endif
                                    @endfor
                                @elseif(isset($occupation))
                                    @foreach(explode(',', $occupation->speciality) as $item)
                                        @if($key == $item) )
                                            {{ 'selected' }}
                                        @endif
                                    @endforeach
                                @endif
                            >{{$value}}</option>
                        @endforeach
                    </optgroup>
                </select>
                <small style="color: red" class="error error_speciality"></small>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="note">Note</label>
                <textarea id="note" class="form-control" cols="100"
                          name="note">{{ old('note') ?? $occupation->note ?? '' }}</textarea>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-xs-12">
            <div class="form-group">
                <label for="note">Bring items</label>
                <textarea id="bringItems" class="form-control " cols="100" name="bring_item"
                          data-parsley-trigger="keyup">{{ old('bring_item') ?? $occupation->bring_items ?? '' }}</textarea>
                <small style="color: red" class="error error_bring_item"></small>
            </div>
        </div>
        <div class="col-lg-6 col-md-3 col-xs-6">
            <label for="skill"> Skill required</label>
            <div class="skill-js" id="TextBoxContainer">
                <table class="table table-skills" id="dynamic_filed">
{{--                    <tr>--}}
{{--                        <td>--}}
{{--                            <div class="form-group">--}}
{{--                                <input type="text" value="{{ [0] }}" name="skill_required[]"--}}
{{--                                       class="form-control">--}}
{{--                                --}}{{--                                                        <small style="color: red" class="error error_skill_required"></small>--}}
{{--                            </div>--}}
{{--                        </td>--}}
{{--                    </tr>--}}
                    @foreach(explode(',', $occupation->skill_required) as $item)
                    <tr>
                        <td>
                            <input type="text" value="{{ $item }}" name="skill_required[]"
                                   class="form-control">
                            {{--                                                    <small style="color: red" class="error error_skill_required"></small>--}}
                        </td>
                        <td>
                            <div class="form-control remoteSkill" style="border: none">
                                <a class="btn-remote mt-4">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                            </div>

                        </td>
                    </tr>
                    @endforeach
                </table>
                <a class="btn-add-new-skill mt-2" id='addSkill'><i
                        class="fas fa-plus"></i></a>
            </div>

        </div>
        <div class="col-lg-12 col-md-12 col-xs-12 mt-4">
            <label class="radio-button">
                <input class="form-check-input" type="radio" value="1"
                       name="status"
                       checked="" id="enableOccupation">
                <label class="form-check-label" for="enableOccupation">Enable</label>
            </label>
            <label class="radio-button-2">
                <input class="form-check-input" type="radio" value="0"
                       name="status"  id="disableOccupation"
                       @if((isset($occupation) && $occupation->status == '0') || old('status') == '0')
                           checked=""@endif>
                <label class="form-check-label" for="disableOccupation">Disable</label>
            </label>
            <small style="color: red" class="error error_status"></small>
        </div>
        <div class="col-12">
            <div class="form-button">
                <div class="row float-right">
                    <button type="button" class="btn btn-secondary">CANCEL</button>
                    <button type="button"
                            class="btn btn-primary btn-model-occupation btn-create-occupation btn-confirm-occupation">
                        UPDATE
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ URL::asset('js/admin/occupation.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.station-select2').select2();
            $('.speciality-select2 ').select2();
            for(let i = 0; i <= imageEditCount; i++) {
                imageArray.push($('#imageEdit'+i).attr('src'));
                count = i;
            }
        });

        let skillArray = [];
        function loadDataAjax(data, confirm = false) {
            $.each(imagePath, function (i, file) {
                if(file != '') {
                    data.append('file[]', file);
                }
            });

            $.each($('input[name="skill_required[]"]'), function (index, value) {
                if(this.value != '') {
                    skillArray.push(this.value);
                    data.append('skill_required[]', this.value);
                }
            });
            $.each(idImageRemove, function (i, value) {
                data.append('idImageRemove[]', value);
            });
            data.append('count_image',imageArray.length - imageArray.filter(function (value) {
                return value == '';
            }).length);
            data.append('title', $('input[name="title"]').val());
            data.append('category_id', $('#category_id').val());
            data.append('description', $('textarea[name="description"]').val());
            data.append('station', $('#station').val());
            data.append('speciality', $('#speciality').val());
            data.append('work_address', $('input[name="work_address"]').val());
            data.append('access_address', $('input[name="access_address"]').val());
            data.append('note', $('textarea[name="note"]').val());
            data.append('bring_item', $('textarea[name="bring_item"]').val());
            data.append('status', $('input[name="status"]:checked').val());
            data.append('confirm', confirm);
            if (data.fake) {
                opts.xhr = function () {
                    var xhr = $.ajaxSettings.xhr();
                    xhr.send = xhr.sendAsBinary;
                    return xhr;
                }
                opts.contentType = "multipart/form-data; boundary=" + data.boundary;
                opts.data = data.toString();
            }
        }

        $('#btn-save-occupation').on('click', function (event) {
            let data = new FormData();
            loadDataAjax(data, true);
            $.ajax({
                url: '{{ route('occupation.update', [$occupation->id]) }}',
                type: "POST",
                data:  data,
                cache:false,
                contentType: false,
                processData: false,
                success: function (data) {
                    location.href = data.url;
                }, error: function (error) {
                    console.log(error);
                }
            }); //end of ajax
        })

        $('#btn-add-update-job').on('click', function (event) {
            let data = new FormData();
            loadDataAjax(data, true);
            $.ajax({
                url: '{{ route('occupation.update', [$occupation->id]) }}',
                type: "POST",
                data:  data,
                cache:false,
                contentType: false,
                processData: false,
                success: function (data) {
                    location.href = data.urlCreateJob;
                }, error: function (error) {
                    console.log(error);
                }
            }); //end of ajax
        })

        $('.btn-create-occupation').on('click', function (event) {
            let data = new FormData();
            loadDataAjax(data);
            let form = $('#form-create-occupation');
            $('.confirm-image-occupation').html('');

            $.ajax({
                url: '{{ route('occupation.update', [$occupation->id]) }}',
                type: "POST",
                data:  data,
                cache:false,
                contentType: false,
                processData: false,
                success: function (data) {
                    setTimeout(function() {
                        confirmOccupation();
                        form.find('.btn-create-occupation').html('SAVE');
                    }, 100);

                    $('.detail-title').html($('input[name="title"]').val());
                    $('.detail-category').html($('#category_id option:selected').text());
                    $('.detail-description').html($('textarea[name="description"]').val());
                    $('.detail-speciality').html( $('#speciality option:selected').text());
                    $('.detail-note').html( $('textarea[name="note"]').val());
                    $('.detail-Bring-items').html($('textarea[name="bring_item"]').val());

                    $('.detail-skill-required').html('');
                    $.each(skillArray, function (index, value) {
                        $('.detail-skill-required').append(
                            value+"<br>"
                        );
                    })
                    skillArray = [];

                    $('.detail-status').html( ($('input[name="status"]:checked').val() == 0) ? 'disable' : 'enable' );

                    $.each(imageArray, function (index, value) {
                        if(value != '' && value) {
                            $('.confirm-image-occupation').append(
                                ' <div class="col-4 mb-2">'+
                                '    <div class="wrap-detail-img">'+
                                '        <img class="view-detail-img" src="'+value+'" alt="Image"/>'+
                                '    </div>'+
                                '</div>'
                            );
                        }
                    })
                }, error: function (error) {
                    setTimeout(function () {
                        form.find('.error').hide();
                        $.each(error.responseJSON.errors, function (key, value) {
                            if (value != null) {
                                $(".error_" + key).html(value[0]);
                                $(".error_" + key).show();
                            }
                        });
                    }, 1000);

                }
            }); //end of ajax
        });
        function confirmOccupation(){
            let html = $('#model_confirm_occupation');
            $('#model_confirm_occupation').modal('show');
        }
    </script>
@endpush


