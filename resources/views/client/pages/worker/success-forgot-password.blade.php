@extends('client.layouts.landing')
@section('title','Home')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/client/pages/successForgot.css')}}">
@endpush
@section('content')
    <div class="options container">
        <span class="mb-0 first-child">パスワード再設定完了</span>
    </div>
    <div class="register-worker-content container">
        <span class="title-worker-register-content">パスワードの再設定が完了しました。</span>
        <br>
        <button class="button-worker-register" data-toggle="modal" data-target="#loginModal">
            <img src="{{ asset('images/icon/log-in.png') }}" style="margin-right: 10px">
            ログインする
        </button>
    </div>
@endsection

