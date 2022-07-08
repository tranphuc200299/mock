@extends('client.layouts.landing')
@section('title', 'Home')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/client/pages/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/pages/confirmUploadFile.css') }}">
@endpush
@section('content')
    <div class="thumb-nail-register-pages container mt-4">
        Page TOP> マイページTOP
    </div>
    <hr class="text__top">
    <div class="profile container">
        <div class="row">
            <div class="col-md-8 col-lg-8 mt-4 order-md-last">
                <div class="text__content">
                    <div class="text__confirm-one">
                        <p>身分証明書アップロード</p>
                    </div>
                    <div class="text__confirm-two d-flex ">
                        <div class="">
                            <img src="{{ asset('images/icon/check-circle.svg') }}" class="icon__upfile" alt="">
                        </div>
                        <p class="text__two">身分証明書の提出を受け付けました。</p>
                    </div>
                </div>

                <div class="mt-4 btn__back-home">
                    <a href="{{ route('home') }}" class="text__btn-back">>マイページTOPへもどる
                        <span> <i class="fa fa-caret-right col-style i__fa-class"></i></span></a>

                </div>
            </div>

            <div class="col-md-4 col-lg-4">
                <div class="profil-left">
                    @if($workerProfile->profile_image)
                    <div class="img-profile">
                        <img src="{{ asset($workerProfile->profile_image) }}" style="margin-right: 10px">
                    </div>
                    @else
                    <div class="img-profile">
                        <img src="{{ asset('images/client/avt.jpg') }}" style="margin-right: 10px">
                    </div>
                    @endif
                    <div class="profile-name">
                        <span>{{ $workerProfile->first_name }} {{ $workerProfile->last_name }}</span>
                    </div>
                    <a href="{{route('edit.profile',['id'=>$workerProfile->worker_id])}}" class="link-upload-profile">
                        <div class="profile-update">
                            <span>ユーザー情報編集</span>
                        </div>
                    </a>
                </div>
                <hr class="profile-hr">
                <div class="setting-profile">
                    <ul>
                        <hr class="hr__one">
                        <li>
                            <i class="fas fa-exclamation-circle" aria-hidden="true" style="color: red"></i>
                            <a class="text-left" href="{{ route('uploadfile.profile') }}">
                                身分証明書アップロード
                                <span class="profile-arrow"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">▶</font></font></span>
                            </a>

                        </li>
                        <hr class="hr__two">
                        <li>
                            <a class="text-left" href="{{ route('degree.profile') }}">
                                資格証明書アップロード
                                <span class="profile-arrow">
                                    <font style="vertical-align: inherit;">▶</font>
                                </span>
                            </a>

                        </li>
                        <hr class="hr__two">
                        <li>
                            <a class="text-left" href="{{ route('worker.logout') }}">
                                ログアウト
                                <span class="profile-arrow"><font style="vertical-align: inherit;">▶</font></span>
                            </a>

                        </li>
                        <hr class="hr__two">
                    </ul>

                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
@endpush
