@extends('client.layouts.landing')
@section('title','Home')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/client/pages/registerWorker.css')}}">
@endpush
@section('content')
    <div class="thumb-nail-register-pages container">
        バイトTOP > 会員登録
    </div>
    <div class="options container">
        <span class="mb-0 first-child">会員登録</span>
    </div>
    <div class="register-worker-content container">
        <span class="title-worker-register-content">以下より登録方法を選択してください。.</span>
        <br>
        <button class="button-worker-register-line">
            <img src="{{ asset('images/icon/LINELOGO.svg') }}" style="margin-right: 10px">
            LINEで会員登録
        </button>
        <br>
        <button class="button-worker-register">
            <img src="{{ asset('images/icon/phone.svg') }}" style="margin-right: 10px">
            電話番号で会員登録
        </button>
    </div>
@endsection
@push('scripts')
    <script>
        $('.button-worker-register').on('click', function () {
            location.href = "{{ route('register.worker.profile') }}";
        });
        $('.button-worker-register-line').on('click', function () {
            location.href = "{{ route('workerLogin.redirectToLine') }}";
        });
    </script>
@endpush

