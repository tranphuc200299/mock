@extends('client.layouts.landing')
@section('title','Home')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/client/pages/forgotPasswordWorker.css')}}">
@endpush
@section('content')
    <div class="header-forgot-page container">
        パスワード再設定
    </div>
    <div class="forgot-password-content container">
        <div class="forgot-password-title">
             <span>登録時に使用した電話番号を入力してください。<br>
           パスワード再設定用のSMSをお送りします。</span>
        </div>
        <form class="forgot-password-input" method="post" action="{{ route('confirm.worker.sms.post', [$id]) }}">
            @csrf
            <lable>電話番号</lable><br>
            <input type="text" placeholder="09012345678(半角)" name="otp">
            @if($errors->has('otp'))
                <small
                    style="color: red;">{{ $errors->first('otp') }}</small>
            @endif
            @if(Session::has('error'))
                <small
                    style="color: red;">{{ Session::get('error') }}</small>
            @endif
            <input type="submit" class="submit-confirm-sms" style="display: none">
        </form>
        <button class="btn-confirm-sms">
            送信する
        </button>
    </div>
@endsection
@push('scripts')
    <script>
        $('.btn-confirm-sms').on('click', function () {
            $('.submit-confirm-sms').click();
        });
    </script>
@endpush

