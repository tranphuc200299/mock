@extends('client.layouts.landing') 
@section('title','Home')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/client/pages/forgotPasswordWorker.css')}}">
@endpush
@section('content')
    <div class="header-forgot-page container">
        パスワード再設定
    </div>
    <form class="forgot-password-content container" method="post" action="{{ route('setPassword.worker.post', ['id' => $id,'token' => $token]) }}">
        @csrf
        <div class="forgot-password-title">
             <span>新しいパスワードを入力し<br>
           「パスワードを再設定する」ボタンを押してください</span>
        </div>
        <div class="forgot-password-input">
            <lable>新パスワード<span style="color: red">*</span></lable><br>
            <input type="password" name="password">
            @if($errors->has('password'))
                <small
                    style="color: red;">{{ $errors->first('password') }}</small>
            @endif
        </div>
        <div class="confirm-password-input">
            <lable>新パスワード(確認)<span style="color: red">*</span></lable><br>
            <input type="password" name="password_confirmation">
            @if($errors->has('password_confirmation'))
                <small
                    style="color: red;">{{ $errors->first('password_confirmation') }}</small>
            @endif
        </div>
        <button>
            パスワードを再設定する
        </button>
    </form>
@endsection

