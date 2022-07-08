@extends('client.layouts.landing')
@section('title','Home')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/client/pages/createWorker.css')}}">
@endpush
@section('content')
    <div class="thumb-nail-register-pages container">
        バイトTOP > 会員登録
    </div>
    <div class="options container">
        <span class="mb-0 first-child">会員登録</span>
    </div>
    <div class="container row worker-profile-content">
        <div class="col-lg-3 col-md-12 sidebar-worker-profile-content">
            <div class="sidebar-worker-profile-item">
                <p>会員登録</p>
                <span class="sidebar-worker-profile-item-span-require">必須</span>
            </div>
            <div class="sidebar-worker-profile-item">
                <p>フリガナ</p>
                <span class="sidebar-worker-profile-item-span-require">必須</span>
            </div>
            <div class="sidebar-worker-profile-item">
                <p>電話番号</p>
                <span class="sidebar-worker-profile-item-span-require">必須</span>
            </div>
            <div class="sidebar-worker-profile-item">
                <p>メールアドレス</p>
                <span class="sidebar-worker-profile-item-span-require">必須</span>
            </div>
            <div class="sidebar-worker-profile-item">
                <p>希望勤務地</p>
                <span class="sidebar-worker-profile-item-span">必須</span>
            </div>
            <div class="sidebar-worker-profile-item">
                <p>プッシュ通知</p>
                <span class="sidebar-worker-profile-item-span">必須</span>
            </div>
        </div>
        <form class="col-lg-9 col-md-12 sidebar-worker-profile-input" method="post" action="{{ route('register.worker.profile.post') }}">
            @csrf
            <div class="sidebar-worker-profile-item-input">
                <div >
                    <lable>姓</lable><br>
                    <input type="text" placeholder="山田" name="first_name" value="{{ old('first_name') }}"><br>
                    @if($errors->has('first_name'))
                        <small
                            style="color: red;">{{ $errors->first('first_name') }}</small>
                    @endif
                </div>
                <div>
                    <lable>名</lable><br>
                    <input type="text" placeholder="太郎" name="last_name" value="{{ old('last_name') }}"><br>
                    @if($errors->has('last_name'))
                        <small
                            style="color: red;">{{ $errors->first('last_name') }}</small>
                    @endif
                </div>
            </div>
            <div class="sidebar-worker-profile-item-input">
                <div >
                    <lable>セイ</lable><br>
                    <input type="text" placeholder="ヤマダ" name="furigana_first_name" value="{{ old('furigana_first_name') }}"><br>
                    @if($errors->has('furigana_first_name'))
                        <small
                            style="color: red;">{{ $errors->first('furigana_first_name') }}</small>
                    @endif
                </div>
                <div>
                    <lable>メイ</lable><br>
                    <input type="text" placeholder="タロウ" name="furigana_last_name"  value="{{ old('furigana_last_name') }}"><br>
                    @if($errors->has('furigana_last_name'))
                        <small
                            style="color: red;">{{ $errors->first('furigana_last_name') }}</small>
                    @endif
                </div>
            </div>
            <div class="sidebar-worker-profile-item-input">
                <input class="sidebar-worker-profile-item-password" type="text" placeholder="090123456789(山田)" name="phone"
                       value="{{ old('phone') }}"><br>
                @if($errors->has('phone'))
                    <small
                        style="color: red;">{{ $errors->first('phone') }}</small>
                @endif
                @if(Session::has('number_phone_error'))
                    <small style="color: red" class="error">{{ Session::get('number_phone_error') }}</small>
                @endif
            </div>
            <div class="sidebar-worker-profile-item-input">
                <input class="sidebar-worker-profile-item-password" type="text" placeholder="greff@example.jp" name="email"
                value="{{ old('email') }}">
                @if($errors->has('email'))
                    <small
                        style="color: red;">{{ $errors->first('email') }}</small>
                @endif
            </div>
            <div class="sidebar-worker-profile-item-input ">
                <div class="select">
                    <select name="area">
                        <option value="" disabled selected>選択</option>
                        @foreach($area as $item)
                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="sidebar-worker-profile-item-input">
                <div>
                    <input id="radio-1" class="radio-custom" name="push_notify" type="radio" value="1">
                    <label for="radio-1" class="radio-custom-label">許可する</label>
                </div>
            </div>
            <input type="submit" id="submit_form_register" style="display: none">
        </form>
        <div class="worker-profile-footer container">
            <a href="#">利用規約</a>
            <span>と</span>
            <a href="#">プライバシーポリシー</a>
            <span>に</span><br>
            <button class="btn-accept-register">
                <a>同意して会員登録する</a>
            </button>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('.btn-accept-register').on('click', function () {
            $('#submit_form_register').click();
        });
    </script>
@endpush

