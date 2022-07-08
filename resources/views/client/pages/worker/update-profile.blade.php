@extends('client.layouts.landing')
@section('title','Home')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/client/pages/profile.css')}}">
@endpush
@section('content')
    <div class="thumb-nail-register-pages container mt-4">
        Page TOP> マイページTOP
    </div>
    <hr>
    <div class="profile container mt-lg-5">
        <div class="row profile_mobile">
            <div class="col-md-4 col-lg-4 profile_mobile-left">
                <div class="profil-left profile-mobile">

                 @if($workerProfile->profile_image)
                 <div class="img-profile">
                    <img src="{{ asset($workerProfile->profile_image) }}" style="margin-right: 10px">
                </div>
                @else
                    <div class="img-profile">
                        <img src="{{ asset('images/client/avt.jpg') }}" style="margin-right: 10px">
                    </div>
                 @endif
                    @if($workerProfile)
                        <div class="profile-name">
                            <span>{{ $workerProfile->first_name }} {{ $workerProfile->last_name }}</span>
                        </div>
                    <a href="{{route('edit.profile',['id'=>$worker->id])}}">
                        <div class="profile-update">
                            <span>ユーザー情報編集</span>
                        </div>
                    </a>
                    @endif
                </div>
                <hr class="profile-hr">
                <div class="setting-profile">
                    <ul>
                        <li>
                            <i class="fas fa-exclamation-circle" aria-hidden="true" style="color: red"></i>
                            <a href="{{ route('uploadfile.profile') }}">
                                身分証明書アップロード
                                <span class="profile-arrow"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">▶</font></font></span>
                            </a>

                        </li>
                        <li>
                            <a href="{{ route('degree.profile') }}">
                                資格証明書アップロード
                                <span class="profile-arrow">
                                    <font style="vertical-align: inherit;">▶</font>
                                </span>
                            </a>

                        </li>
   
                        <li>
                            <a href="{{ route('worker.logout') }}">
                                ログアウト
                                <span class="profile-arrow"><font style="vertical-align: inherit;">▶</font></span>
                            </a>

                        </li>
                    </ul>

                </div>
            </div>
{{--            {{ route('worker.profile.update', [$editProfile->id]) }}--}}
            <div class="col-md-8 col-lg-8 profile_mobile-right">
                <form action="{{ route('worker.profile.update', [$worker->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                  
                 <div class="title-update-profile">
                    <span>ユーザー情報編集</span>
                </div>
{{--                <div class="noti-update-profile mb-4">--}}
{{--                    <span>ユーザー情報を更新しました。</span>--}}
{{--                </div>--}}
                <div class="row">
                    <div class="wrap-header-backgroup wrap-header-boder col-lg-3 col-md-12">
                        <div class="title-update">
                            <span>
                                アイコン写真
                            </span>
                        </div>
                    </div>
                    <div class="wrap-header-boder col-lg-9 col-md-12">
                        <div class="about-item-profile">
                         @if($workerProfile->profile_image)
                            <div class="image-update-profile">
                                <img src="{{ asset($workerProfile->profile_image) }}" id="avt-default" style="margin-right: 10px">
                                <img id="previewImg">
                            </div>
                            @else
                            <div class="image-update-profile">
                                <img src="{{ asset('./images/client/avt.jpg') }}" id="avt-default" style="margin-right: 10px">
                                <img id="previewImg">
                            </div>
                        @endif
                            <div class="icon-image-profile" for="input-file1">
                                <input type="file" name="profile_image" id="input-file1" onchange="previewFile(this);" class="form-control-file upload-file-company">
                                <img src="{{ asset('./images/icon/component.png') }}" alt="" id="default">
                                <span>画像をアップロード</span>
                            </div>
                        </div>
                        @if($errors->has('profile_image'))
                        <small
                                style="color: red;">{{ $errors->first('profile_image') }}</small>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="wrap-header-backgroup wrap-header-boder col-lg-3 col-md-12">
                        <div class="title-update-input">
                            <span>
                              氏名
                            </span>
                        </div>
                    </div>
                    <div class="wrap-header-boder col-lg-9 col-md-12">
                        <div class="about-item-profile">
                            <div class="input-profile">
                                <lable>姓</lable><br>
                                <input id="first_name" maxlength="20" type="text" name="first_name" class="input-box form-control " placeholder="山田" value="{{$workerProfile->first_name}}">
                                @if($errors->has('first_name'))
                                <small
                                    style="color: red;">{{ $errors->first('first_name') }}</small>
                                @endif
                            </div>
                            <div class="input-profile">
                                <lable>名</lable><br>
                                <input id="last_name" maxlength="20" type="text" name="last_name" class="input-box form-control " placeholder="太郎" value="{{$workerProfile->last_name}}">
                                @if($errors->has('last_name'))
                                <small
                                    style="color: red;">{{ $errors->first('last_name') }}</small>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="wrap-header-backgroup wrap-header-boder col-lg-3 col-md-12">
                        <div class="title-update-input">
                            <span>
                             フリガナ
                            </span>
                        </div>
                    </div>
                    <div class="wrap-header-boder col-lg-9 col-md-12">
                        <div class="about-item-profile">
                            <div class="input-profile">
                                <lable>セイ</lable><br>
                                <input id="furigana_first_name" maxlength="20" type="text" name="furigana_first_name" class="input-box form-control " placeholder="ヤマダ"
                                       value="{{$workerProfile->furigana_first_name}}">
                                @if($errors->has('furigana_first_name'))
                                <small
                                    style="color: red;">{{ $errors->first('furigana_first_name') }}</small>
                                @endif
                            </div>
                            <div class="input-profile">
                                <lable>メイ</lable><br>
                                <input id="furigana_last_name" maxlength="20" type="text" name="furigana_last_name" class="input-box form-control " placeholder="タロウ"
                                       value="{{$workerProfile->furigana_last_name}}" >
                                       @if($errors->has('furigana_last_name'))
                                <small
                                    style="color: red;">{{ $errors->first('furigana_last_name') }}</small>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="wrap-header-backgroup wrap-header-boder col-lg-3 col-md-12">
                        <div class="title-update-radio">
                            <span>
                             性別
                            </span>
                        </div>
                    </div>
                    <div class="wrap-header-boder col-lg-9 col-md-12">
                        <div class="radio-about mt-4">
                            <div class="radio1">
                                <input id="radio-1" class="radio-custom" name="gender" type="radio" value="1" checked="checked"
                                @if((isset($workerProfile) && $workerProfile->gender == 1) || old('gender') == '1')
                                checked=""@endif>
                                @if($errors->has('gender'))
                                <small
                                    style="color: red;">{{ $errors->first('gender') }}</small>
                                @endif
                                <label for="radio-1" class="radio-custom-label">男性</label>
                            </div>
                            <div class="radio2">
                                <input id="radio-2" class="radio-custom" name="gender" type="radio" value="2" selected
                                @if((isset($workerProfile) && $workerProfile->gender == 2) || old('gender') == '2')
                                                 checked=""@endif
                                >
                                @if($errors->has('gender'))
                                <small
                                    style="color: red;">{{ $errors->first('gender') }}</small>
                                @endif
                                <label for="radio-2" class="radio-custom-label">女性</label>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- vvv --}}

                <div class="row">
                    <div class="wrap-header-backgroup wrap-header-boder col-lg-3 col-md-12">
                        <div class="title-update-phone">
                            <span>
                                生年月日
                            </span>
                        </div>
                    </div>
                    <div class="wrap-header-boder col-lg-9 col-md-12">
                        <div class="about-item-profile-phone">
                            <div class="input-profile-phone">
                                <input type="date" id="meeting-time"
                                name="birthday" value="{{$workerProfile->birthday}}"
                                min="1901-06-07T00:00" max="2022-12-14T00:00" class="input-box form-control">
                                @if($errors->has('birthday'))
                                <small
                                    style="color: red;">{{ $errors->first('birthday') }}</small>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                {{--  --}}
                <div class="row">
                    <div class="wrap-header-backgroup wrap-header-boder col-lg-3 col-md-12">
                        <div class="title-update-phone">
                            <span>
                           電話番号
                            </span>
                        </div>
                    </div>
                    <div class="wrap-header-boder col-lg-9 col-md-12">
                        <div class="about-item-profile-phone">
                            <div class="input-profile-phone">
                                <input id="phone" maxlength="20" type="text" name="phone" class="input-box form-control " placeholder="山田"  value="{{$worker->phone}}">
                                @if($errors->has('phone'))
                                <small
                                    style="color: red;">{{ $errors->first('phone') }}</small>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="wrap-header-backgroup wrap-header-boder col-lg-3 col-md-12">
                        <div class="title-update-email">
                            <span>
                           メールアドレス
                            </span>
                        </div>
                    </div>
                    <div class="wrap-header-boder col-lg-9 col-md-12">
                        <div class="about-item-profile-email">
                            <div class="input-profile-email">
                                <input id="email" type="text" name="email" class="input-box form-control "  value="{{$worker->email}}">
                                @if($errors->has('email'))
                                <small
                                    style="color: red;">{{ $errors->first('email') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="email-profile-title">
                            <span>*メール受信制限をされている方は、greff.jpからの受信を許可してください。</span><br>
                            <span>*入力間違いが多くなっておりますので、ご注意ください。</span>
                        </div>
                    </div>
                </div>
{{-- password --}}
                <div class="row">
                    <div class="wrap-header-backgroup wrap-header-boder col-lg-3 col-md-12">
                        <div class="title-update-email">
                            <span>
                            パスワード
                            </span>
                        </div>
                    </div>
                    <div class="wrap-header-boder col-lg-9 col-md-12">
                        <div class="about-item-profile-password">
                            <div class="input-profile-password">
                                <input id="password" type="password" name="password" class="input-box form-control "
                                  value="......." readonly>                      
                            </div>
                            <div class="title-pasword">
                                <label>セキュリティ上の理由からパスワードは隠されています</label>
                            </div>
                        
                            <div class="password-button f-right">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">                                
                                    変更
                                  </button>
                            </div>
                        </div>
                    </div>
                </div>      
{{-- passs --}}
                <div class="row">
                    <div class="wrap-header-backgroup wrap-header-boder col-lg-3 col-md-12">
                        <div class="title-update-email">
                            <span>
                           希望勤務地
                            </span>
                        </div>
                    </div>
                    <div class="wrap-header-boder col-lg-9 col-md-12">
                        <div class="select-adress">
                            <div class="select">
                                <select name="area">
                                    <option value="" disabled selected>選択</option>
                                    @foreach($area->take(3) as $item)
                                        <option
                                            value="{{ $item->name}}"
                                            @if($workerProfile->area == $item->name)
                                                selected
                                            @endif
                                            >{{ $item->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="wrap-header-backgroup wrap-header-boder col-lg-3 col-md-12">
                        <div class="title-update-radio">
                            <span>
                             プッシュ通知
                            </span>
                        </div>
                    </div>
                    <div class="wrap-header-boder col-lg-9 col-md-12">
                        <div class="radio-about-infor mt-4">
                            <div class="radio1">
                                <input id="radio-3" class="radio-custom" name="push_notify" type="radio" value="3" selected
                                @if((isset($worker) && $worker->push_notify == 3) || old('push_notify') == '3')
                                checked=""@endif >
                                <label for="radio-3" class="radio-custom-label"><b>許可する</b></label>
                            </div>
                            <div class="radio2">
                                <label for="radio-2" class="radio-custom-label">*新着求人やキャンペーンのお知らせがすぐに届きます！</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">

                    </div>
                    <div class="col-lg-6">
                        <button class="btn-accept-register">
                            <a><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">同意して会員登録する</font></font></a>
                        </button>
                    </div>
                    <div class="col-lg-3">

                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@include('client.modals.changePassWord')

@endsection
@push('scripts')
    <script>
        $('#previewImg').hide();
        $("#input-file1").on('change',function(){
            $('#avt-default').hide();
            $('#previewImg').show();
        });

        function previewFile(input){
            var file = $("input[type=file]").get(0).files[0];

            if(file){
                var reader = new FileReader();

                reader.onload = function(){
                    $("#previewImg").attr("src", reader.result);
                }

                reader.readAsDataURL(file);
            }
        }


        $('#changePasswordWorker').on('submit', function(e){
            e.preventDefault();
            $.ajax({
                url:$(this).attr('action'),
                method:$(this).attr('method'),
                data:new FormData(this),
                processData:false,
                dataType:'json',
                contentType:false,
                beforeSend:function(){
                $(document).find('span.error-text').text('');
                },
                success:function(data){
                    console.log(data);
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                    $('span.'+prefix+'_error').text(val[0]);
                    });
                }else{
                    $('#changePasswordWorker')[0].reset();
                    // toastr.success(data.msg);
                    alert(data.msg);
                    window.location.href = "{{ route('edit.profile', [$worker->id]) }}";
                }
                }
            });
    });
    </script>
     @if(Session ::has('success'))
     <script>
         toastr.success('update profile worker success');
     </script>
 @endif
@endpush

