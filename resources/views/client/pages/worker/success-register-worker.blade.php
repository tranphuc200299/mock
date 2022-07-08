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
            山田 太郎様、登録いただきありがとうございます。<br>
            登録メールアドレスへ確認のメールをお送りしました。<br>
            万が一メールが届かない場合は、<a href="#" style="text-decoration: underline">マイページ</a>からメールアドレスが正しいかご確認ください。
        </p>
        <button class="success-register-button">
            さっそくお仕事を探す！
            <span class="arrow-success-register-button">&#10148;</span>
        </button>
    </div>
@endsection
@push('scripts')
    <script>
        $('.success-register-button').on('click', function () {
           location.href = "{{ route('home') }}";
        });
    </script>
@endpush


