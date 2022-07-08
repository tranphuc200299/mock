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
        <div class="row">
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
            <div class="col-md-8 col-lg-8">
                <div class="profile-right">
                    <div class="title-profile">
                        <span>マイページTOP</span>
                    </div>
                    <div class="error-profile">
                        <ul class="list-error-profile">
                            <li class="active-title">
                                <span class="error-title mt-5">お知らせ</span>
                            </li>
                            <li>
                                <i class="fas fa-exclamation-circle" aria-hidden="true"></i>
                                <span class="m-1">身分証明書をアップロードしてください。</span>
                            </li>
                            <li>
                                <i class="fa fa-exclamation-circle" aria-hidden="true"></i>
                                <span class="m-1">給与振込口座が未登録です。</span>
                            </li>
                        </ul>
                    </div>
                    <div class="right-content-profile">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6">
                                <h1>1200</h1>
                                <span>合計稼働時間</span>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <h1>30</h1>
                                <span>ペナルティ</span>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="money-box">
                                    <span>引き出し可能額</span>
                                    <div class="money-box-content">
                                        <div class="money">
                                            <h3>￥10,900</h3>
                                        </div>
                                        {{--                                           <div class="money-right">--}}
                                        {{--                                               <span>引き出す</span>--}}
                                        {{--                                           </div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')

@endpush

