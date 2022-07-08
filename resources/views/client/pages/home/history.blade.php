@extends('client.layouts.landing')
@section('title','Home')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/client/pages/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/pages/style.css')}}">
@endpush
@section('content')
    <div class="job-list-section">
        <div class="container job-list-block">
            <div class="job-list">
                {{-- content jobs--}}
                <div class="row infinite-scroll">
                    @foreach($jobs as $job)
                        <div class="col-xl-4 col-lg-3 col-6 job-item-wrap">
                        <div class="job-item">
                            <div class="job-image">
                                <a href="#">
                                    <img src="{{ asset(get_image_occupation_by_id($job->occupation->id)[0]->path) }}" alt="">
                                </a>
                            </div>
                            <div class="job-info">
                                <div class="job-info-date">
                                    <img src="{{ asset('images/icon/calendar.svg') }}" alt="">
                                    <span class="job-info-date-text">{{ \Carbon\Carbon::parse($job->work_date)->month }}月
                                {{ \Carbon\Carbon::parse($job->work_date)->day }}日
                                ({{ App\Librarys\DAYOFWEEK[\Carbon\Carbon::parse($job->work_date)->dayOfWeek] }})</span>
                                </div>
                                <div class="d-sm-flex">
                                    <div class="job-area job-info-item" data-toggle="tooltip" data-placement="top" title="東京都千代田区">
                                        <img src="{{ asset('images/icon/map-pin.svg') }}" alt="">
                                        東京都千代田区
                                    </div>
                                    <div class="job-time job-info-item">
                                        <img src="{{ asset('images/icon/clock.svg') }}" alt="">
                                        11:00 - 15:00
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="job-title-wrap">
                                    <a href="{{ route('get.detail.job',[$job->id]) }}" >
                                        <div class="job-title">
                                            {{ $job->occupation->title }}
                                        </div>
                                    </a>
                                </div>
                                <div class="job-salary">
                                    ￥ {{ number_format($job->total_amount)}}
                                </div>
                                <div class="job-summary">
                                    <div class="job-summary-item-list">
                                        {{--SPECIALITY web--}}
                                        <div class="pc-display">
                                            <div class="job-summary-item color-1" data-toggle="tooltip" title="即採用">
                                                <img src="./images/icon/smile.png" alt="" width="20" height="20">
                                                <div class="summary-item-text">即採用</div>
                                            </div>
                                            <div class="job-summary-item color-2" data-toggle="tooltip" title="まかない">
                                                <img src="./images/icon/mom.png" alt="" width="20" height="20">
                                                <div class="summary-item-text">まかない</div>
                                            </div>
                                            <div class="job-summary-item color-3" data-toggle="tooltip" title="駅近">
                                                <img src="./images/icon/box.png" alt="" width="20" height="20">
                                                <div class="summary-item-text">駅近</div>
                                            </div>
                                            <div class="job-summary-item color-2" data-toggle="tooltip" title="未経験者歓迎">
                                                <img src="./images/icon/smile.png" alt="" width="20" height="20">
                                                <div class="summary-item-text">未経験者歓迎</div>
                                            </div>
                                            <div class="job-summary-item color-1" data-toggle="tooltip" title="交通費支給">
                                                <img src="./images/icon/mom.png" alt="" width="20" height="20">
                                                <div class="summary-item-text">交通費支給</div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        {{--SPECIALITY mobile--}}
                                        <div class="sp-display">
                                            <div class="job-summary-item color-4  small-summary-item " data-toggle="tooltip" title="即採用">
                                                <img src="https://greff.co.jp/assets/images/homepage/spec_icon_speed_matching.svg" alt="" width="20" height="20">
                                                <div class="summary-item-text">即採用</div>
                                            </div>
                                            <div class="job-summary-item color-1  small-summary-item " data-toggle="tooltip" title="まかない">
                                                <img src="https://greff.co.jp/assets/images/homepage/spec_icon_lunch.svg" alt="" width="20" height="20">
                                                <div class="summary-item-text">まかない</div>
                                            </div>
                                            <div class="job-summary-item color-1  small-summary-item " data-toggle="tooltip" title="駅近">
                                                <img src="https://greff.co.jp/assets/images/homepage/spec_icon_near_station.svg" alt="" width="20" height="20">
                                                <div class="summary-item-text">駅近</div>
                                            </div>
                                            <div class="job-summary-item color-2  small-summary-item " data-toggle="tooltip" title="未経験者歓迎">
                                                <img src="https://greff.co.jp/assets/images/homepage/spec_icon_no_exp.svg" alt="" width="20" height="20">
                                                <div class="summary-item-text">未経験者歓迎</div>
                                            </div>
                                            <div class="job-summary-item color-1  small-summary-item " data-toggle="tooltip" title="交通費支給">
                                                <img src="https://greff.co.jp/assets/images/homepage/spec_icon_travel_fee.svg" alt="" width="20" height="20">
                                                <div class="summary-item-text">交通費支給</div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            {{--action web--}}
                            <div class="job-action text-center">
                                <div class="row">
                                    <div class="col-8 col-xl-8 col-style">
                                        <a href="#">
                                            <div class="detail-job">詳細を見る<span><i class="fa fa-caret-right"></i></span></div>
                                        </a>
                                    </div>
                                    <div class="col-4 col-xl-4 col-style">
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
                            {{--action mobile--}}
                            <div class="favorite-sp" data-id="{{ $job->id }}"
                                 @if(isset($workerFavorite) && $workerFavorite != null)
                                     @foreach($workerFavorite as $item)
                                         @if($job->id == $item->id)
                                             style="background-image: url('{{ asset('images/icon/star_sp_yellow.svg') }}')"
                                         @endif
                                     @endforeach
                                @endif>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

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
                        $(active).css("background-image", "url('{{ asset('images/icon/star-yellow.svg') }}')");
                    } else {
                        $(active).css("background-image", "url('{{ asset('images/icon/star.svg') }}')");
                    }
                    $('.header-favorite').html(''+data.countFavorite)

                },error:function(){
                    console.log('error');
                }
            });//end ajax
        });
        $('body').on('click', '.favorite-sp', function () {
            let active = this;
            $.ajax({
                url: '{{ route('addFavorite') }}',
                type:"Post",
                data: {
                    "id": $(this).data('id'),
                },
                success:function(data){
                    if(data.active) {
                        $(active).css("background-image", "url('{{ asset('images/icon/star_sp_yellow.svg') }}')");
                    } else {
                        $(active).css("background-image", "url('{{ asset('images/icon/star_sp.svg') }}')");
                    }
                    $('.header-favorite').html(''+data.countFavorite)

                },error:function(){
                    console.log('error');
                }
            });//end ajax
        });
    </script>
@endpush

