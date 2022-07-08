@extends('client.layouts.landing')
@section('title','Home')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/client/pages/successForgot.css')}}">
@endpush
@section('content')
    <div class="container text-center" style="margin-top: 100px">
        <div style="margin-bottom: 40px">
            <b style="font-size: 20px">会員登録完了</b>
        </div>

        <p style="margin-bottom: 40px">
            アカウントの登録に成功しました。お礼のメールが受信トレイに送信されました。<br>
            メールに添付されている確認リンクにアクセスして、登録を完了してください
        </p>
    </div>
@endsection


