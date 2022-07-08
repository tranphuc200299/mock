@extends('client.layouts.landing')
@section('title', 'Home')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/client/pages/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client/pages/uploadFile.css') }}">
@endpush
@section('content')

    <div class="thumb-nail-register-pages container mt-4">
        Page TOP> マイページTOP
    </div>
    <hr>
    <div class="profile container">
        <div class="row">
            <div class="col-md-8 col-lg-8 mt-4 order-md-last">
                {{-- id="fileUpload" --}}
                <div class="text__top-uploadfile">
                    <p class="text__top-file">身分証明書アップロード</p>
                </div>
                <div class="text__top2-uploadfile mt-4">
                    <p class="text__top2-file"> 本人確認のため、氏名・住所・生年月日が記載された本人確認書類（運転免許証・健康保険証・パスポート・ 住民票のいずれか）を撮影してご提出ください。
                    </p>
                </div>

                <form action="{{ route('uploadfile.store') }}" method="post" enctype="multipart/form-data">
                    <div class="file__upload">
                        <div class="row">
                            <div class="col-12 col-md-6 ">
                                <div class="upload__file-one fileupload ">
                                    @if($workerProfile->passport_image_back != null)
                                        <img id="previewImg" class="preview-passport" src="{{ $workerProfile->passport_image_front }}">
                                    @else
                                        <img id="previewImg2" class="preview-passport">
                                    @endif
                                        @csrf
                                        <div class="image__uploadfile-one mt-2">

                                            <input type="file" name="passport_image_front" class="file"
                                                id="file_choose" onchange="previewFile(this);" >
                                            <img src="{{ asset('images/icon/camera_blue.svg') }}" class="img__upload"
                                                alt="">

                                        </div>

                                        <div class="text__title-one mt-4">
                                            <p>本人確認書類の</p>
                                        </div>
                                        <div class="text__title-two mt-2">
                                            <p>表面写真</p>
                                        </div>
                                </div>
                                @error('passport_image_front')
                                <span style="color:red;">{{ $message }}
                                </span>
                            @enderror
                            </div>
                            <div class="col-12 col-md-6  ">
                                <div class="upload__file-one fileupload2">
                                    @if($workerProfile->passport_image_back != null)
                                        <img id="previewImg2" class="preview-passport" src="{{ $workerProfile->passport_image_back }}">
                                    @else
                                        <img id="previewImg2" class="preview-passport">
                                    @endif

                                    <div class="image__uploadfile-one mt-2">
                                        <input type="file" name="passport_image_back" id="file_choose2" class="file"
                                            onchange="previewFile(this);" >

                                        <img src="{{ asset('images/icon/camera_blue.svg') }}" class="img__upload" alt="">
                                    </div>
                                    <div class="text__title-one mt-4">
                                        <p>本人確認書類の</p>
                                    </div>
                                    <div class="text__title-two mt-2">
                                        <p>表面写真</p>
                                    </div>
                                </div>
                                @error('passport_image_back')
                                <span style="color:red; " id="back">{{ $message }}
                                </span>
                            @enderror
                            </div>
                        </div>
                    </div>
                    @if( Session::get('worker')->profile->status != 0)
                        <div class="btn__send mt-4" >
                            {{-- <a class="text__btn-send ">提出する</a> --}}
                            <input type="submit" class="text__send-btn w-100" value="提出する">
                        </div>
                    @endif
                </form>
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
                                <span class="profile-arrow">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">▶</font>
                                    </font>
                                </span>
                            </a>

                        </li>
                        <hr class="hr__two">
                        <li>
                            <a  class="text-left" href="{{ route('degree.profile') }}">
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
                                <span class="profile-arrow">
                                    <font style="vertical-align: inherit;">▶</font>
                                </span>
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
    <script>
        /* click to div on input */
        $('.fileupload').click(function(e) {
            $(this).find('input[type="file"]').click();
        });

        $('.fileupload input').click(function(e) {
            e.stopPropagation();
        });
        /*----2----*/
        $('.fileupload2').click(function(e) {
            $(this).find('input[type="file"]').click();
        });

        $('.fileupload2 input').click(function(e) {
            e.stopPropagation();
        });

        /* freview */
        function previewFile(input) {
            console.log($(input));
            var file = $(input).get(0).files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function() {
                    let prevew = $(input).parents('.upload__file-one').find('.preview-passport');
                    prevew.attr("src", reader.result);
                    prevew.show();
                }
                reader.readAsDataURL(file);
            }

        }
    </script>
@endpush
