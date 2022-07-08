@extends('client.layouts.landing')
@section('title', 'Detail')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/client/pages/detail.css') }}">
@endpush
@section('content')
    @php
        $images = get_image_occupation_by_id($job->occupation->id);
    @endphp
    <div class="breadcrumb-list mt-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">TOP</a></li>
                    <li class="breadcrumb-item active" aria-current="page">※経験者用※【大塚駅南口】買取のテレアポスタッフ！</li>
                </ol>
            </nav>
        </div>
    </div>
    <!------------------------------------------>
    <div class="owl-carousel owl-theme">
        @foreach($images as $image)
            <div class="item">
                <img src="{{ asset($image->path) }}" alt="{{ $image->title }}" class="img__style">
            </div>
        @endforeach
    </div>
    <div class="container" style="padding-top: 31px">
        <div class="row job-info-wrap">
            <div class="col-12 col-xl-7 job-info">
                <div class="row">
                    <div class="col-12 col-xl-4 date-need">
                        <div class="date-need-content">
                            <img src="{{ asset('images/icon/calendar.svg') }}" alt="">
                            <span class="job-info-date-text">{{ $job->work_date }}</span>
                        </div>
                    </div>
                    <div class="col-4 col-xl-3 place-need">
                        <div class="place-need-content" data-toggle="tooltip" data-placement="top" title="" data-original-title="東京都豊島区">
                            <img src="{{ asset('images/icon/bus.svg') }}" alt="">
                            <span class="place-need-text">表参道駅</span>
                        </div>
                    </div>
                    <div class="col-6 col-xl-4 time-need">
                        <div class="time-need-content">
                            <img src="{{ asset('images/icon/clock.svg') }}" alt="">
                            <span class="time-need-text">
                                {{ date("H:i", strtotime($job->work_time_from)) }} -
                                {{ date("H:i", strtotime($job->work_time_to)) }}
                            </span>
                        </div>
                    </div>
                </div>
                <h1 class="job-title">
                    {{ $job->occupation->title }}
                </h1>
                <div class="salary">
                    ￥{{ number_format($job->total_amount)}}
                </div>
                <div class="job-description">
                    {{ $job->occupation->description }}
                </div>
                <div class="job-summary-info">
                    <div class="job-summary-item-list">
                        @foreach(explode(",", $job->occupation->speciality) as $item)
                            <div class="job-summary-item color-{{ rand(0,4) }}" data-toggle="tooltip" title="" data-original-title="{{ App\Librarys\SPECIALITY[$item] }}">
                                @if($item == 1 || $item == 4 || $item == 0 || $item == 12 || $item == 13)
                                    <img src="{{ asset('images/icon/moon.svg') }}" alt="" width="20" height="20">
                                @elseif($item == 2 || $item == 5 || $item == 8 || $item == 11)
                                    <img src="{{ asset('images/icon/gift.svg') }}" alt="" width="20" height="20">
                                @elseif($item == 3 || $item == 6 || $item == 9 || $item == 10)
                                    <img src="{{ asset('images/icon/smile.svg') }}" alt="" width="20" height="20">
                                @endif
                                <div class="summary-item-text">{{ App\Librarys\SPECIALITY[$item] }}</div>
                            </div>
                        @endforeach
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-1 blank-col"></div>
            <div class="col-xl-4 action-button">
                <div class="period-text count-time-job" id="countdown-time"
                     data-date="{{ $job->deadline_for_apply }}">
                    あと<span>0日0時間0分0秒</span>で募集締め切り
                </div>
                <div class="row action-wrap">
                    <div class=" col-xl-8 apply-wrap">

                        @if($job->deadline_for_apply > Carbon\Carbon::now())
                            <div class="button-apply"
                                 @if(Session::has('worker')) data-bs-toggle="modal" data-bs-target="#message_appve_modal"
                                 @else data-bs-toggle="modal" data-bs-target="#message_login_modal"
                                @endif>
                                <a class="apply" href="javascript:void(0)">
                                    この求人に応募する
                                </a>
                            </div>
                        @else
                            <div class="button-apply btn-disable-apply">
                                <a class="apply" href="javascript:void(0)">
                                    この求人に応募する
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class=" col-xl-4">
                        <div class="multi-fav favorite" data-id="{{ $job->id }}"
                             @if(isset($workerFavorite) && $workerFavorite != null)
                                 @foreach($workerFavorite as $item)
                                     @if($job->id == $item->id)
                                         style="background-image: url('{{ asset('images/icon/star-yellow.svg') }}')"
                                    @endif
                                @endforeach
                            @endif>
                            <div class="favorite-text">キープする</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="job-detail-block">
            <div class="job-detail-title">
                求人詳細
            </div>
            <div class="row job-detail-content">
                <div class="col-xl-6">
                    <div class="row detail-job-item">
                        <div class="col-4 col-xl-3 job-item-title-wrap">
                            <div class="job-item-title">
                                <div class="title-image"><img src="{{ asset('images/icon/clock.svg') }}" alt=""></div>
                                <div class="title-text">勤務日時</div>
                            </div>
                        </div>
                        <div class="col-8 col-xl-9 job-item-content-wrap">
                            <div class="job-item-content">
                                <div class="big-text">
                                    {{ $job->work_date }}
                                    {{ date("H:i", strtotime($job->work_time_from)) }} -
                                    {{ date("H:i", strtotime($job->work_time_to)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row detail-job-item">
                        <div class="col-4 col-xl-3 job-item-title-wrap">
                            <div class="job-item-title">
                                <div class="title-image"><img src="{{ asset('images/icon/977_mo_h.svg') }}" alt=""></div>
                                <div class="title-text">時給</div>
                            </div>
                        </div>
                        <div class="col-8 col-xl-9 job-item-content-wrap">
                            <div class="job-item-content">
                                <div class="big-text">
                                    {{ number_format($job->salary_per_hour) }}円
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row detail-job-item">
                        <div class="col-4 col-xl-3 job-item-title-wrap">
                            <div class="job-item-title">
                                <div class="title-image"><img src="{{ asset('images/icon/ega.svg') }}" alt=""></div>
                                <div class="title-text">交通費</div>
                            </div>
                        </div>
                        <div class="col-8 col-xl-9 job-item-content-wrap">
                            <div class="job-item-content">
                                一部支給 上限 {{ number_format($job->travel_fees) }}円まで
                            </div>
                        </div>
                    </div>
                    <div class="row detail-job-item">
                        <div class="col-4 col-xl-3 job-item-title-wrap">
                            <div class="job-item-title">
                                <div class="title-image"><img src="{{ asset('images/icon/cafe.svg') }}" alt=""></div>
                                <div class="title-text">休憩時間</div>
                            </div>
                        </div>
                        <div class="col-8 col-xl-9 job-item-content-wrap">
                            <div class="job-item-content">
                                {{ number_format($job->break_time) }}分
                            </div>
                        </div>
                    </div>
                    <div class="row detail-job-item">
                        <div class="col-4 col-xl-3 job-item-title-wrap">
                            <div class="job-item-title">
                                <div class="title-image"><img src="{{ asset('images/icon/folder-regular.svg') }}" alt=""></div>
                                <div class="title-text">業種</div>
                            </div>
                        </div>
                        <div class="col-8 col-xl-9 job-item-content-wrap">
                            <div class="job-item-content">
                                {{ $job->occupation->category->name }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    @if($job->occupation->skill_required)
                        <div class="row detail-job-item">
                            <div class="col-4 col-xl-3 job-item-title-wrap">
                                <div class="job-item-title">
                                    <div class="title-image"><img src="{{ asset('images/icon/award.svg') }}" alt=""></div>
                                    <div class="title-text">応募資格</div>
                                </div>
                            </div>
                            <div class="col-8 col-xl-9 job-item-content-wrap">
                                <div class="job-item-content">
                                    <ul class="ul-custom-job-page p-0">
                                        @foreach(explode(",", $job->occupation->skill_required) as $skill)
                                            <li>{{ $skill }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($job->occupation->bring_items)
                        <div class="row detail-job-item">
                            <div class="col-4 col-xl-3 job-item-title-wrap">
                                <div class="job-item-title category-title">
                                    <div class="title-image"><img src="{{ asset('images/icon/briefcase.svg') }}" alt=""></div>
                                    <div class="title-text">持ち物</div>
                                </div>
                            </div>
                            <div class="col-8 col-xl-9 job-item-content-wrap">
                                <div class="job-item-content">
                                    <p class="career-name">{{ $job->occupation->bring_items }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($job->occupation->work_address)
                        <div class="row detail-job-item">
                        <div class="col-4 col-xl-3 job-item-title-wrap">
                            <div class="job-item-title">
                                <div class="title-image"><img src="{{ asset('images/icon/map-pin.svg') }}" alt=""></div>
                                <div class="title-text">勤務地</div>
                            </div>
                        </div>
                        <div class="col-8 col-xl-9 job-item-content-wrap">
                            <div class="job-item-content long-detail">
                                {{ $job->occupation->work_address }}
                            </div>
                            <div class="job-item-content long-detail mt-lg-2">
                                <a href="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' {{ str_replace(',', '', str_replace(' ', '+', $job->occupation->work_address)) }}"
                                   target="_blank" class="btn btn-map">Google Map <img class="ms-1" src="{{ asset('images/icon/external-link.svg') }}"></a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($job->occupation->access_address)
                        <div class="row detail-job-item">
                            <div class="col-4 col-xl-3 job-item-title-wrap">
                                <div class="job-item-title">
                                    <div class="title-image"><img src="{{ asset('images/icon/map-pin.svg') }}" alt=""></div>
                                    <div class="title-text">アクセス</div>
                                </div>
                            </div>
                            <div class="col-8 col-xl-9 job-item-content-wrap">
                                <div class="job-item-content long-detail">
                                    {{ $job->occupation->access_address }}
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($job->occupation->note)
                        <div class="row detail-job-item">
                            <div class="col-4 col-xl-3 job-item-title-wrap">
                                <div class="job-item-title">
                                    <div class="title-image"><img src="{{ asset('images/icon/alert-circle.svg') }}" alt=""></div>
                                    <div class="title-text">注意事項</div>
                                </div>
                            </div>
                            <div class="col-8 col-xl-9 job-item-content-wrap">
                                <div class="job-item-content long-detail">
                                    {{ $job->occupation->note }}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="address-mobile">
        <div class="address-content ps-4 pe-3">
            <div class="title-text mb-3">
                勤務地
            </div>
            <div class="job-item-content">
                東京都渋谷区宇田川町３６-２　 ノア渋谷４０２号室
            </div>
            <div class="job-item-content">
                表参道駅A5出口から徒歩5分
            </div>
        </div>
        <div class="address-map mt-3">
            <iframe frameborder="0" style="width: 100%;"
                    src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' {{ str_replace(',', '', str_replace(' ', '+', $job->occupation->work_address)) }}
                    '&z=14&output=embed"></iframe>
        </div>
    </div>
    <div class="action-button-block">
        <div class="period-text count-time-job">
            あと<span>0日0時間0分0秒</span>で募集締め切り
        </div>
        <div class="action-button-wrap">
            <div class="row">
                <div class=" col-8 col-xl-8 apply-wrap">
                    @if($job->deadline_for_apply > Carbon\Carbon::now())
                        <div class="button-apply-2"
                             @if(Session::has('worker')) data-bs-toggle="modal" data-bs-target="#message_appve_modal"
                             @else data-bs-toggle="modal" data-bs-target="#message_login_modal"
                            @endif>
                            <a class="apply" href="javascript:void(0)">
                                このお仕事を申し込む
                            </a>
                        </div>
                    @else
                        <div class="button-apply-2 btn-disable-apply">
                            <a class="apply" href="javascript:void(0)">
                                このお仕事を申し込む
                            </a>
                        </div>
                    @endif

                </div>
                <div class="col-4 col-xl-4">
                    <div class="multi-fav favorite" data-id="{{ $job->id }}"
                         @if(isset($workerFavorite) && $workerFavorite != null)
                             @foreach($workerFavorite as $item)
                                 @if($job->id == $item->id)
                                     style="background-image: url('{{ asset('images/icon/star-yellow.svg') }}')"
                                @endif
                            @endforeach
                        @endif>
                        <div class="favorite-text">キープする</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--modal message login --}}
    @include('client.pages.job.modal-message-login')
    @include('client.pages.job.modal-appve')
@endsection
@push('scripts')
    <script>
        $('body').on('click', '.favorite', function () {
            let active = this;
            $.ajax({
                url: '{{ route('addFavorite') }}',
                type:"Post",
                data: {
                    "id": $(this).data('id'),
                },
                success:function(data){
                    if(data.active) {
                        $('.favorite').css("background-image", "url('{{ asset('images/icon/star-yellow.svg') }}')");
                    } else {
                        $('.favorite').css("background-image", "url('{{ asset('images/icon/star.svg') }}')");
                    }
                    $('.header-favorite').html(''+data.countFavorite)

                },error:function(){
                    console.log('error');
                }
            });//end ajax
        });

        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            dots:false,
            nav:true,
            navText: ["<i class='fa fa-chevron-left' aria-hidden='true'></i>","<i class='fa fa-chevron-right' aria-hidden='true'></i>"],
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:3
                }
            }
        })

        $("document").ready(function() {

            let countDownDate = new Date($("#countdown-time" ).data( "date" )).getTime();
            let x = setInterval(function() {

                // Get today's date and time
                let now = new Date().getTime();
                console.log(countDownDate);
                // Find the distance between now and the count down date
                let distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                $(".count-time-job span").html( days + "日 " + hours + "時間 "
                    + minutes + "分 " + seconds + "秒 ");

                // If the count down is over, write some text
                if (distance < 0) {
                    clearInterval(x);
                    $(".count-time-job").html("<span>"+"この仕事に応募できません"+"</span>");
                    $(".count-time-job span").css("color", "red");
                    $(".button-apply-2").addClass('btn-disable-apply');
                    $(".button-apply").addClass('btn-disable-apply');
                }
            }, 1000);
        });

    </script>
@endpush
