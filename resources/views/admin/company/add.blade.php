@extends('admin.layouts.admin')

@section('title')
    Company
@endsection

@section('content')

    <div class="content-wrapper">
        <?php $keyThumbnail = isset($company) ? 'edit' : 'add'; ?>
        @include('admin.partials.content-header',['name' => 'Company ','key'=> $keyThumbnail ])
        <!-- Content Header (Page header) -->
        <div class="content my-2">
            <div class="card card-warning">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                           role="tab" aria-controls="nav-home" aria-selected="true">Genneral information</a>
                        <a class="nav-item nav-link <?php echo isset($company) ? '' : 'disabled' ?>"
                           id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                           role="tab" aria-controls="nav-profile" aria-selected="false"> Login account</a>
                    </div>
                </nav>
                <div class="tab-content nav-tabContent-company" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="tab-content" id="nav-tabContent">
                            @if(isset($company))
                                <form method="post"
                                      action="{{ route('company.update', [$company->id]) }}">
                                    @method('PUT')
                                    @else
                                        <form method="post" action="{{ route('company.store') }} ">
                                            @endif
                                            @csrf
                                            <div class="card-body">
                                                <div class="row">
                                                    <h3>Status</h3>
                                                </div>
                                                <div class="row">
                                                    <label class="radio-button">
                                                        <input class="form-check-input" type="radio" value="1"
                                                               name="status"
                                                               checked="">
                                                        <label class="form-check-label">Enable</label>
                                                    </label>
                                                    <label class="radio-button-2">
                                                        <input class="form-check-input" type="radio" value="0"
                                                               name="status"
                                                               @if((isset($company) && $company->status == 0) || old('status') == '0')
                                                                   checked=""@endif>
                                                        <label class="form-check-label">Disable</label>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group" style="position: relative">
                                                        <input type="text" class="form-control form-control-lg"
                                                               placeholder="Company name" name="companyName"
                                                               value="{{ old('companyName') ?? $company->company_name ?? '' }}">
                                                        @if(!isset($company))
                                                            <span class="red_star_placeholder">*</span>
                                                        @endif
                                                        @if($errors->has('companyName'))
                                                            <small
                                                                style="color: red;">{{ $errors->first('companyName') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg"
                                                               placeholder="Company name (Kana)" name="companyKanaName"
                                                               value="{{ old('companyKanaName') ?? $company->company_name_kana ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg"
                                                               placeholder="Register name" name="registerName"
                                                               value="{{ old('registerName') ?? $company->register_name ?? ''}}">
                                                        @if(!isset($company))
                                                            <span class="red_star_placeholder">*</span>
                                                        @endif
                                                        @if($errors->has('registerName'))
                                                            <small
                                                                style="color: red;">{{ $errors->first('registerName') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg"
                                                               placeholder="Register name (kana)"
                                                               name="registerKanaName"
                                                               value="{{ old('registerKanaName') ?? $company->register_name_kana ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">

                                                    <div class="form-group">
                                                        <label class="Area">City <span style="color: red">*</span></label>
                                                        <select class="form-control form-control-lg" id="city"
                                                                name="city">
                                                            <option value="" disabled selected></option>
                                                            @foreach($cities as $city)
                                                                @if($city->katakana_name == old('city'))
                                                                    <option
                                                                        value="{{$city->katakana_name}}"
                                                                        selected>{{$city->katakana_name}}</option>
                                                                @elseif(isset($company) && $city->katakana_name == $company->city)
                                                                    <option
                                                                        value="{{$city->katakana_name}}"
                                                                        selected>{{$city->katakana_name}}</option>
                                                                @endif
                                                                <option
                                                                    value="{{$city->katakana_name}}">{{$city->katakana_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('city'))
                                                            <small
                                                                style="color: red;">{{ $errors->first('city') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="Area">District <span style="color: red">*</span></label>
                                                        <select class="form-control form-control-lg" id="district"
                                                                name="district">
                                                            <option value="" disabled selected>
                                                            @if(isset($company))
                                                                <option
                                                                    value="{{$company->district}}"
                                                                    selected>{{$company->district}}</option>
                                                            @else
                                                                <option
                                                                    value="{{ old('district') }}"
                                                                    selected>{{ old('district') }}</option>
                                                            @endif
                                                        </select>
                                                        @if($errors->has('district'))
                                                            <small
                                                                style="color: red;">{{ $errors->first('district') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg"
                                                               placeholder="Room" name="room"
                                                               value="{{ old('room') ?? $company->room ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg"
                                                               placeholder="Building" name="building"
                                                               value="{{ old('building') ?? $company->building ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg"
                                                               placeholder="Zipcode" name="zipCode"
                                                               value="{{ old('zipCode') ?? $company->zip_code ?? '' }}">
                                                        @if(!isset($company))
                                                            <span class="red_star_placeholder red_star_placeholder_zipUrl">*</span>
                                                        @endif
                                                        @if($errors->has('zipCode'))
                                                            <small
                                                                style="color: red;">{{ $errors->first('zipCode') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg"
                                                               placeholder="HP URL" name="hpUrl"
                                                               value="{{ old('hpUrl') ?? $company->hp_url ?? '' }}">
                                                        @if(!isset($company))
                                                            <span class="red_star_placeholder red_star_placeholder_zipUrl">*</span>
                                                        @endif
                                                        @if($errors->has('hpUrl'))
                                                            <small
                                                                style="color: red;">{{ $errors->first('hpUrl') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group area-select2">
                                                        <label class="Area">Area <span style="color: red">*</span></label>
                                                        <select class="form-control js-select2" name="area[]"
                                                                multiple="multiple"
                                                                placeholder="Area"
                                                                style="position: relative">
                                                            @foreach($cities as $city)
                                                                <option value="{{$city->name}}"
                                                                @if(old('area'))
                                                                    @for( $i =0; $i < count(old('area')); $i++)
                                                                        @if($city->name == old('area.'.$i) )
                                                                            {{ 'selected' }}
                                                                            @endif
                                                                        @endfor
                                                                    @elseif(isset($company) && in_array($city->name,explode('|',$company->area_intends_to_recuit)))
                                                                    {{ 'selected' }}
                                                                    @endif
                                                                >{{$city->name}}</option>
                                                            @endforeach

                                                        </select>
                                                        @if($errors->has('area'))
                                                            <small
                                                                style="color: red;">{{ $errors->first('area') }}</small>
                                                        @endif
                                                        <a href="" id="select2" data-toggle="modal" class="selec2-Area"
                                                           data-target="#exampleModalArea">Select</a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group career-select2">
                                                        <label class="Career">Career <span style="color: red">*</span></label>
                                                        <select class="form-control js-select2" multiple="multiple"
                                                                name="career[]"
                                                                placeholder="Career"
                                                                style="position: relative; ">
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->name}}"
                                                                @if(old('career'))
                                                                    @for( $i =0; $i < count(old('career')); $i++)
                                                                        @if($category->name == old('career.'.$i) )
                                                                            {{ 'selected' }}
                                                                            @endif
                                                                        @endfor
                                                                    @elseif(isset($company) && in_array($category->name,explode('|',$company->career)))
                                                                    {{ 'selected' }}
                                                                    @endif
                                                                >{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if($errors->has('career'))
                                                            <small
                                                                style="color: red;">{{ $errors->first('career') }}</small>
                                                        @endif
                                                        <a href="" id="select2" data-toggle="modal"
                                                           data-target="#exampleModalCenterCareer"
                                                           class="selec2-career">Select</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <label>Contact information</label>
                                            <div class="row">
                                                <div class="col-sm-4 col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg"
                                                               placeholder="Contact name" name="contactName"
                                                               value="{{ old('contactName') ?? $company->contact_name ?? ''}}">
                                                        @if(!isset($company))
                                                            <span class="red_star_placeholder">*</span>
                                                        @endif
                                                        @if($errors->has('contactName'))
                                                            <small
                                                                style="color: red;">{{ $errors->first('contactName') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg"
                                                               placeholder="Phone Number" name="phoneNumber"
                                                               value="{{ old('phoneNumber') ?? $company->phone ?? ''}}">
                                                        @if(!isset($company))
                                                            <span class="red_star_placeholder">*</span>
                                                        @endif
                                                        @if($errors->has('phoneNumber'))
                                                            <small
                                                                style="color: red;">{{ $errors->first('phoneNumber') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-4 col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-lg"
                                                               placeholder="Email" name="email"
                                                               value="{{ old('email') ?? $company->email ?? '' }}">
                                                        @if(!isset($company))
                                                            <span class="red_star_placeholder red_star_placeholder_zipUrl">*</span>
                                                        @endif
                                                        @if($errors->has('email'))
                                                            <small
                                                                style="color: red;">{{ $errors->first('email') }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Other</label>
                                                        <select class="form-control form-control-lg" name="other">
                                                            <option>{{ old('other') ?? $company->other ??'The reason for knowing Greff' }}</option>
                                                            <option>企業のホームページ</option>
                                                            <option>インターネット広告</option>
                                                            <option>メルマガ</option>
                                                            <option>. ブログ ・SNS</option>
                                                            <option>家族・友人・知人のクチコミSNS</option>
                                                            <option> その他</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 col-lg-12 col-md-12">
                                                    <div class="form-group">
                                            <textarea class="form-control" rows="3" placeholder="Note"
                                                      name="note">{{ old('note') ?? $company->note ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-button">
                                                <div class="row float-right">
                                                    <button type="button" class="btn btn-secondary">CANCEL</button>
                                                    <button type="submit" class="btn btn-primary">SAVE</button>
                                                </div>
                                            </div>
                                        </form>
                        </div>
                    </div>
                    {{-- tab list user of company--}}
                    @if(isset($company))
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="content">
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 p-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3 float-right">
                                                <div class="register" data-target="#register">
                                                    <a href="" class="btn-add-new open-model-user" id="select2"
                                                       data-toggle="modal"
                                                       data-target="#register"> <i class="fas fa-plus"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 float-right">
                                            <table id="table-list-company" class="table table-bordered" role="grid"
                                                   aria-describedby="example2_info">
                                                <thead class="thead-light">
                                                <tr role="row">
                                                    <th class="sorting sorting_asc">ID</th>
                                                    <th class="sorting">Name</th>
                                                    <th class="sorting">Email</th>
                                                    <th class="sorting">Status</th>
                                                    <th class="sorting">Created date</th>
                                                    <th class="sorting"></th>
                                                </tr>
                                                </thead>
                                                <tbody id="tbody-list-user">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    </div>
    <style>
        .red_star_placeholder {
            color: red;
            font-size: 23px;
            position: absolute;
            top: 23px;
            left: 150px
        }
        .red_star_placeholder_zipUrl {
            left: 100px
        }
    </style>
    @include('admin.modal.company.modal-career')
    @include('admin.modal.company.modal-area')

    @if(isset($company))
        @include('admin.modal.company.register')
    @endif
    {{-- modal comfirm delete user--}}
    @include('admin.modal.company.popup-confirm-delete-user')
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        fetchDataUser();
        $('#city').change(function () {
            let url = '{{ route('company.getDistrict') }}'
            let name = $(this).val()
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    name: name,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#district').empty()
                    $('#district').append('<option value="" disabled selected></option>')
                    console.log(res);
                    $.each(res, function (index, value) {
                        $('#district').append('<option value="' + value['katakana_name'] + '">' + value['katakana_name'] + '</option>')
                    })
                },
                error: function (res) {
                    console.log(res)
                }

            })
        })

        $('.form-control').on('keyup', function () {
            $(this).parent('.form-group').find('.red_star_placeholder').css('display', 'none');
        })

        $(document).ready(function () {
            $('.js-select2').select2();
        });

        function fetchDataUser() {
            let id = '{{ $company->id ?? '' }}';
            $.ajax({
                url: URL_GET_USER_COMPANY,
                method: "GET",
                data: {
                    id
                },
                success: function (data) {
                    $('#tbody-list-user').html(data.body);
                }
            });
        }

        $('body').on('click', '.btn-delete-user', function () {
            let id = $(this).data('id');
            $('#input-confirm-id').val(id);
        });

    </script>
@endpush


