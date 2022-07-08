@extends('admin.layouts.admin')

@section('title')
    Edit worker
@endsection
@section('content')
    <div class="content-wrapper">
        @include('admin.partials.content-header',['name' => 'Worker ','key'=> 'Edit' ])
        <!-- Content Header (Page header) -->
        <div class="content my-2">
            <div class="card card-warning">
                <div class="tab-content nav-tabContent-company" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="tab-content" id="nav-tabContent">
                            <form method="post" action="{{ route('admin.worker.update', [$worker ->id]) }}">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <p>Status confirmation information</p>
                                    </div>
                                    <div class="row">
                                        <label class="radio-button">
                                            <input class="form-check-input" type="radio" value="1"
                                                   name="verify_email"
                                                   checked id="statusEnable">
                                            <label class="form-check-label" for="statusEnable">Enable</label>
                                        </label>
                                        <label class="radio-button-2">
                                            <input class="form-check-input" type="radio" value="0"
                                                   name="verify_email"
                                                   @if(old('verify_email') == '0' || $worker->verify_email == '0')
                                                       checked
                                                   @endif  id="statusDisable">
                                            <label class="form-check-label" for="statusDisable">Disable</label>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg"
                                                   placeholder="First name" name="first_name"
                                                   value="{{ old('first_name') ?? $profile->first_name ?? '' }}">
                                            @if($errors->has('first_name'))
                                                <small
                                                    style="color: red;">{{ $errors->first('first_name') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg"
                                                   placeholder="Last name" name="last_name"
                                                   value="{{ old('last_name') ?? $profile->last_name ?? '' }}">
                                            @if($errors->has('last_name'))
                                                <small
                                                    style="color: red;">{{ $errors->first('last_name') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg"
                                                   placeholder="First kana name" name="furigana_first_name"
                                                   value="{{ old('furigana_first_name') ?? $profile->furigana_first_name ?? '' }}">
                                            @if($errors->has('furigana_first_name'))
                                                <small
                                                    style="color: red;">{{ $errors->first('furigana_first_name') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg"
                                                   placeholder="Last kana name" name="furigana_last_name"
                                                   value="{{ old('furigana_last_name') ?? $profile->furigana_last_name ?? '' }}">
                                            @if($errors->has('furigana_last_name'))
                                                <small
                                                    style="color: red;">{{ $errors->first('furigana_last_name') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body row">
                                   <div class="col-6">
                                       <div class="row">
                                           <p>Gender</p>
                                       </div>
                                       <div class="row">
                                           <label class="radio-button">
                                               <input class="form-check-input" type="radio" value="1"
                                                      name="gender"
                                                      @if(old('gender') == '1' || $profile->gender == '1')
                                                          checked
                                                      @endif
                                                      id="male">
                                               <label class="form-check-label" for="male">Male</label>
                                           </label>
                                           <label class="radio-button-2">
                                               <input class="form-check-input" type="radio" value="0"
                                                      name="gender"
                                                      @if(old('gender') == '0' || $profile->gender == '0')
                                                          checked
                                                      @endif
                                                      id="female">
                                               <label class="form-check-label" for="female">Female</label>
                                           </label>
                                           <label class="radio-button-2">
                                               <input class="form-check-input" type="radio" value="2"
                                                      name="gender"
                                                      @if(old('gender') == '2' || $profile->gender == null)
                                                          checked
                                                      @endif
                                                      id="other">
                                               <label class="form-check-label" for="other">Other</label>
                                           </label>
                                       </div>
                                   </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group area-select2">
                                            <select class="form-control" name="area">
                                                <option value="" disabled selected>Area</option>
                                                @foreach($areas as $area)
                                                    <option value="{{ $area->name }}"
                                                    @if($area->name == $profile->area )
                                                        {{ 'selected' }}
                                                    @endif
                                                    @if(old('area'))
                                                        @if($area->name == old('area') )
                                                            {{ 'selected' }}
                                                        @endif
                                                    @endif
                                                    >{{ $area->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="date" class="form-control form-control-lg"
                                                   name="birthday" max="{{ date('Y').'-12-31' }}"
                                                   value="{{ date('Y-m-d', strtotime($profile->birthday)) }}">
                                            @if($errors->has('birthday'))
                                                <small
                                                    style="color: red;">{{ $errors->first('birthday') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg"
                                                   placeholder="Email" name="email"
                                                   value="{{ old('email') ?? $worker->email ?? '' }}">
                                            @if($errors->has('email'))
                                                <small
                                                    style="color: red;">{{ $errors->first('email') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-lg"
                                                   placeholder="Phone number" name="phone"
                                                   value="{{ old('phone') ?? $worker->phone ?? '' }}">
                                            @if($errors->has('phone'))
                                                <small
                                                    style="color: red;">{{ $errors->first('phone') }}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <p class="label-column">Certificate</p>
                                <div class="row">
                                    @for ($i = 0; $i < count(get_image_degree_by_id($worker->profile->id)); $i++)
                                        <div class="col-3">
                                            <img class="certificate__image" src="{{ asset(get_image_degree_by_id($worker->profile->id)[$i]->path) }}"/>
                                        </div>
                                    @endfor

                                </div>
                                <p class="label-column" style="margin-top: 30px">Personal information</p>
                                <div class="row" style="margin-bottom: 10px">
                                    <div class="col-6 d-flex">
                                        <span>Front</span>
                                        <img class="passport__image passport__image__front" src="{{ $profile->passport_image_front }}"/>
                                    </div>
                                    <div class="col-6 d-flex">
                                        <span>Back</span>
                                        <img class="passport__image passport__image__back"  src="{{ $profile->passport_image_back }}"/>
                                    </div>
                                </div>
                                <div style="margin-top: 50px">
                                    <p>Status of confirmation information</p>
                                </div>
                                <div class="row">
                                    <label class="radio-button">
                                        <input class="form-check-input" type="radio" value="3"
                                               name="status"
                                               checked
                                               id="not_upload">
                                        <label class="form-check-label" for="not_upload">Not upload</label>
                                    </label>
                                    <label class="radio-button-2">
                                        <input class="form-check-input" type="radio" value="2"
                                               name="status"
                                               @if(old('status') == '2' || $profile->status == '2')
                                                   checked
                                               @endif
                                               id="waiting_approve">
                                        <label class="form-check-label" for="waiting_approve">Waiting approve</label>
                                    </label>
                                    <label class="radio-button-2">
                                        <input class="form-check-input" type="radio" value="0"
                                               name="status"
                                               @if(old('status') == '0' || $profile->status == '0')
                                                   checked
                                               @endif
                                               id="approved">
                                        <label class="form-check-label" for="approved">Approved</label>
                                    </label>
                                </div>
                                <div class="form-button">
                                    <div class="row float-right">
                                        <button type="button" class="btn btn-secondary cancel-worker-edit">CANCEL</button>
                                        <button type="submit" class="btn btn-primary">SAVE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .certificate__image {
            width: 100%;
            border: 8px solid #ccc;
            margin: 0px 5px;
        }
        .passport__image {
            width: 400px;
            margin: 0px 10px;
        }
    </style>
@endsection
@push('scripts')
    <script>
        $('.cancel-worker-edit').on('click', function () {
            location.href = "{{ route('admin.worker.index') }}";
        })
    </script>
@endpush

