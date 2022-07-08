@extends('admin.store.form')
@section('form')
    <form method="post" action="{{ route('store.store') }} ">
        @csrf
        <div class="card-body">
            <div class="row">
                <h3>Status</h3>
            </div>
            <div class="row">
                <label class="radio-button">
                    <input class="form-check-input" type="radio" value="1"
                           name="status"
                           checked="" id="statusEnable">
                    <label class="form-check-label" for="statusEnable">Enable</label>
                </label>
                <label class="radio-button-2">
                    <input class="form-check-input" type="radio" value="0"
                           name="status"
                           @if(old('status') == '0')
                               checked=""@endif id="statusDisable">
                    <label class="form-check-label" for="statusDisable">Disable</label>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg"
                           placeholder="Store name" name="storeName"
                           value="{{ old('storeName') ?? '' }}">
                    <span class="red_star_placeholder" style="left: 130px">*</span>
                    @if($errors->has('storeName'))
                        <small
                            style="color: red;">{{ $errors->first('storeName') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg"
                           placeholder="Store name (Kana)" name="storeKanaName"
                           value="{{ old('storeKanaName') ?? ''}}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <select class="form-control form-control-lg" id="city"
                            name="city">
                        <option value="" selected>City</option>
                        @foreach($cities as $city)
                            @if($city->katakana_name == old('city'))
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
                    <select class="form-control form-control-lg" id="district"
                            name="district">
                        <option value="" selected>District</option>
                        @if( old('district') != '')
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
            <div class="col-sm-12">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg"
                           placeholder="Address" name="address"
                           value="{{ old('address') ?? '' }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group area-select2">
                    <select class="form-control js-select2" name="area[]"
                            multiple="multiple"
                            style="position: relative; ">
                        @foreach($routes as $route)
                            <option value="{{ $route->id }}"
                            @if(old('area'))
                                @for( $i =0; $i < count(old('area')); $i++)
                                    @if($route->id == old('area.'.$i) )
                                        {{ 'selected' }}
                                    @endif
                                @endfor
                            @endif
                            >{{ $route->getStationByRoute($route->parent_id)->name }} / {{ $route->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg"
                           placeholder="HP URL" name="hpUrl"
                           value="{{ old('hpUrl') ?? '' }}">
                    @if($errors->has('hpUrl'))
                        <small
                            style="color: red;">{{ $errors->first('hpUrl') }}</small>
                    @endif
                </div>
            </div>
        </div>
        <label>Person in change</label>
        <div class="row">
            <div class="col-sm-4 col-lg-4">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg"
                           placeholder="Name" name="person_in_charge_name"
                           value="{{ old('person_in_charge_name') ?? ''}}">
                    <span class="red_star_placeholder" style="left: 80px">*</span>
                    @if($errors->has('person_in_charge_name'))
                        <small
                            style="color: red;">{{ $errors->first('person_in_charge_name') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg"
                           placeholder="Phone Number" name="person_in_charge_phone_number"
                           value="{{ old('person_in_charge_phone_number') ?? ''}}">
                    <span class="red_star_placeholder">*</span>
                    @if($errors->has('person_in_charge_phone_number'))
                        <small
                            style="color: red;">{{ $errors->first('person_in_charge_phone_number') }}</small>
                    @endif
                </div>
            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg"
                           placeholder="Email" name="person_in_charge_email"
                           value="{{ old('person_in_charge_email') ?? '' }}">
                    <span class="red_star_placeholder" style="left: 80px">*</span>
                    @if($errors->has('person_in_charge_email'))
                        <small
                            style="color: red;">{{ $errors->first('person_in_charge_email') }}</small>
                    @endif
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
    <style>
        .red_star_placeholder {
            color: red;
            font-size: 23px;
            position: absolute;
            top: 23px;
            left: 150px
        }
    </style>
@endsection
@push('scripts')
    <script>
        $('.form-control').on('keyup', function () {
            $(this).parent('.form-group').find('.red_star_placeholder').css('display', 'none');
        })
    </script>
@endpush
