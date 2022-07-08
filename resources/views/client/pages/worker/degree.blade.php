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
                                <span class="profile-arrow">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">▶</font>
                                    </font>
                                </span>
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
                                <span class="profile-arrow">
                                    <font style="vertical-align: inherit;">▶</font>
                                </span>
                            </a>

                        </li>
                    </ul>
                </div>
            </div>
            <form class="col-md-8 col-lg-8 mt-4" method="post" action="{{ route('degree.profile.upload') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="delete_image_array" id="delete_image_array">
                <div class="text__top-uploadfile">
                    <p class="text__top-file">資格証明書アップロード</p>
                </div>
                <div class="text__top2-uploadfile mt-4">
                    <p class="text__top2-file"> 紙媒体の証明書のみお手元にある方は、スマートフォンやデジタルカメラで証明書を撮影してください。
                    </p>
                </div>
                <div class="file__upload">
                    <div class="row">
                        @for ($i = 0; $i < count(get_image_degree_by_id($workerProfile->id)); $i++)
                            <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                                <div class="degree" data-id="{{ $i }}">
                                    <div class="upload__file-one fileupload">
                                        <img id="previewImg2" class="preview-passport" src="{{ asset(get_image_degree_by_id($workerProfile->id)[$i]->path) }}">
                                        <div class="image__uploadfile-one degree">
                                            <input type="file" name="degree[]" class="file"
                                                   id="file_choose" onchange="previewFile(this);" >
                                            <img src="{{ asset('images/icon/camera_blue.svg') }}" class="img__upload"
                                                 alt="">
                                        </div>
                                        <div class="text__title-two mt-4 degree-title">
                                            <p>資格証明書をアップロード</p>
                                        </div>
                                    </div>
                                    <div class="remove-degree remove-degree-isset">
                                        <a class="btn-add-new"> <i class="fa fa-minus" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endfor
                        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
                            <div id="block-degree">

                            </div>
                            <div class="and-remote">
                                <div class="add-degree btn-add-new-block">
                                    <a class="btn-add-new"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn__send mt-4 border-0 d-block" type="submit">
                        <a class="text__btn-send ">提出する</a>
                    </button>
            </div>
        </form>
    </div>
    </div>

@endsection
<script type="text/html" id="html_degree">
    <div class="degree">
        <div class="upload__file-one fileupload">
            <img id="previewImg2" class="preview-passport">
            <div class="image__uploadfile-one degree">
                <input type="file" name="degree[]" class="file"
                    id="file_choose" onchange="previewFile(this);" >
                <img src="{{ asset('images/icon/camera_blue.svg') }}" class="img__upload"
                    alt="">
            </div>
            <div class="text__title-two mt-4 degree-title">
                <p>資格証明書をアップロード</p>
            </div>
        </div>
        <div class="remove-degree">
            <a class="btn-add-new"> <i class="fa fa-minus" aria-hidden="true"></i></a>
        </div>
    </div>
</script>


@push('scripts')
  <script>
      let imagePath = [];
      /* freview */
        $('.fileupload').click(function(e) {
            $(this).find('input[type="file"]').click();
        });

        $('.fileupload input').click(function(e) {
            e.stopPropagation();
        });

    function previewFile(input) {
        var file = $(input).get(0).files[0];
        if (file) {
            imagePath.push(input.files[0]);
            var reader = new FileReader();
            reader.onload = function() {
                let prevew = $(input).parents('.upload__file-one').find('.preview-passport');
                prevew.attr("src", reader.result);
                prevew.show();
            }
            reader.readAsDataURL(file);
        }
    }

    const HTML = $('#html_degree').html();
    $('body').on('click', '.btn-add-new-block', function(event) {
        event.preventDefault();
        $('#block-degree').append(HTML);
    });

    $('body').on('click', '.remove-degree', function () {
        $(this).parents('.degree').remove();
    });
      $('body').on('click', '.remove-degree-isset', function () {
          if($('#delete_image_array').val()) {
              $('#delete_image_array').val($('#delete_image_array').val() + ',' + $(this).parents('.degree').data('id'));
          } else {
              $('#delete_image_array').val($('#delete_image_array').val() + $(this).parents('.degree').data('id'));
          }
          $(this).parents('.degree').remove();
      });

    </script>
    @if(Session::has('success'))
        <script>
            toastr.success('update degree worker success');
        </script>
    @endif
@endpush
