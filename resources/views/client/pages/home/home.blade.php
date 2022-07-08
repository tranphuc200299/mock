@extends('client.layouts.landing')
@section('title','Home')
@push('styles')
    <link rel="stylesheet" href="{{asset('css/client/pages/home.css')}}">
    <link rel="stylesheet" href="{{asset('css/client/pages/style.css')}}">
@endpush
@section('content')
    <div class="options">
        <div class="sticky-menu">
            <div class="container">
                <div class="row sticky-menu-wrap">
                    <div class="search-wrap">
                        <div class="row">
                            <div class="col-xl-9">
                                <div class="text-wrap">
                                    <div class="date-text-selected">5月26日（木）／5月27日（金）／5月28日（土）</div>
                                    <span>のお仕事</span> <span class="number-searched">67件</span>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="button-clear-search button-up-top">
                                    条件を変更する
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="history-stick">
                        <div class="row">
                            <div class="col-xl-6 history-style-button">
                                <div class="list-fav-wrap-stick">
                                    <a href="#">
                                        <div class="list-fav">
                                            キープリスト
                                            <div class="badge show-favorite header-favorite">
                                                {{ Session::get('favorite') == null ? 0 : count(Session::get('favorite')) }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="border-nav pc-display"></div>
                            <div class="col-xl-6 history-style-button">
                                <div class="history-view-wrap-stick">
                                    <a class="text-nowrap" href="#">
                                        <div class="history-view">
                                            閲覧履歴
                                            <div class="badge show-history">
                                                {{ Session::get('history') == null ? 0 : count(Session::get('history')) }}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- slider filter date--}}
        <div class="date-select-section">
            <div class="container date-selector">
                <div class="date-select-title">
                    働きたい日を選択 <span>（10件まで選択可）</span>
                </div>
                <div class="date-select-block owl-carousel owl-theme">
                    @foreach($allDays as $day)
                        <div class="date-item filter-job-homepage" data-date="{{ $day['date'] }}"
                             data-date-text="{{ $day['month'] }}月{{ $day['day'] }}日（{{ App\Librarys\DAYOFWEEK[$day['dayofweek']] }})">
                            <div class="item-content">
                                <div class="date">{{ $day['month'] }}月{{ $day['day'] }}日</div>
                                <div class="weekday ">
                                     <span class="day_of_w_{{ $day['dayofweek'] }}">
                                         {{ App\Librarys\DAYOFWEEK[$day['dayofweek']] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
    <div class="job-list-section">
        <div class="container job-list-block">
            <div class="job-list-title">
                <div class="date-text-selected">5月29日（日）／5月30日（月）</div>
                <span>のお仕事</span> <span class="number-of-job">66件</span>
            </div>
            <div class="filter row">
                <div class="col-12 col-xl-9 filter-row-wrap">
                    <div class="row">
                        <div class="filter-wrap col-4 col-xl-4">
                            <div class="filter-item item-change area-selector text-stations">
                                <span><img src="{{ asset('images/icon/crosshairs-solid.svg') }}"></span> 現在地から絞る
                            </div>
                        </div>
                        <div class="filter-wrap col-4 col-xl-4">
                            <div class="filter-item item-change area-selector text-stations" data-bs-toggle="modal" data-bs-target="#modal-area-filter">
                                <span>▼</span> 市区町村から絞る
                            </div>
                        </div>
                        <div class="filter-wrap col-4 col-xl-4">
                            <div class="filter-item item-change major-selector" data-bs-toggle="modal" data-bs-target="#modal-category-filter">
                                <span>▼</span> 職種から絞る
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>

            <div class="job-list">
                <ul class="nav nav-pills job-tab row" id="pills-tab" role="tablist">
                    <li class="nav-item col-4 col-xl-2">
                        <a class="nav-link sort-tab active" id="pills-home-tab" data-bs-toggle="pill"
                           data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                           aria-selected="true" data-sort="work_date"> 日付順</a>
                    </li>
                    <li class="nav-item col-4 col-xl-2">
                        <a class="nav-link sort-tab" id="pills-profile-tab" data-bs-toggle="pill"
                           data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-profile"
                           aria-selected="false" data-sort="created_at">新着順</a>
                    </li>
                    <li class="nav-item col-4 col-xl-2">
                        <a class="nav-link sort-tab" id="pills-contact-tab" data-bs-toggle="pill"
                           data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-contact"
                           aria-selected="false" data-sort="salary">給与順</a>
                    </li>
                </ul>

                {{-- content jobs--}}
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                         aria-labelledby="pills-home-tab">

                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                         aria-labelledby="pills-profile-tab">

                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                         aria-labelledby="pills-contact-tab">

                    </div>
                    <div class="show-more" id="show-more">
                        <div class="button-show-more">
                            もっと見る
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal filter  --}}
    @include('client.pages.home.modal-area-filter')
    @include('client.pages.home.modal-categories-filter')
@endsection

@push('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            nav:true,
            margin:10,
            dots: false,
            autoWidth: true,
            navText: ["<div class='nav-btn prev-slide'>▲</div>","<div class='nav-btn next-slide'>▲</div>"],
            responsive:{
                0:{
                    items:4
                },
                600:{
                    items:3
                },
                1000:{
                    items:7
                }
            }
        })

        $(document).ready(function () {
            //init variable
            var filterDate = new Array();
            var page = 1;
            var orderBy = 'work_date';
            var CategoryParent = new Array();
            var CategoryChild = new Array();
            var filterArea = new Array();
            var cityId = new Array();
            var routeId = new Array();
            var areaId = new Array();
            //get 3 days
            $('.filter-job-homepage').each(function(i, obj) {
                let $this = $(this);
                if(i < 3){
                    let date = [];
                    $this.toggleClass("selected");
                    let key = $this.data('date');
                    let text = $this.data('date-text');
                    if($this.hasClass('selected')){
                        date['key'] = key;
                        date['text'] = text;
                        filterDate.push(date);
                    }else {
                        filterDate = filterDate.filter(function(obj){
                            return obj.key !== key;
                        });
                    }
                    showTextDate();
                }
            });
            $('body').on('click', '.filter-job-homepage', function () {
                let $this = $(this);
                if(!$this.hasClass('selected') && filterDate.length >= 10){
                    alert('一度に選択できる日付は10件までです。');
                }else {
                    page = 1;
                    let date = [];
                    $this.toggleClass("selected");
                    let key = $this.data('date');
                    let text = $this.data('date-text');
                    if($this.hasClass('selected')){
                        date['key'] = key;
                        date['text'] = text;
                        filterDate.push(date);
                    }else {
                        filterDate = filterDate.filter(function(obj){
                            return obj.key !== key;
                        });
                    }
                    showTextDate();
                    filterData();
                }
            });

            function showTextDate() {
                let text = '';
                if(filterDate.length == 0){
                    text = 'すべて';
                }else if(filterDate.length <= 3){
                    $.each( filterDate, function( key, value ) {
                        if(key == 0){
                            text += value.text ;
                        }else{
                            text += ' ／' + value.text ;
                        }

                    });
                }else {
                    text += `選択した${filterDate.length}日間`
                }
                $('.date-text-selected').html(text);
            }
            filterData();
            // function filter jobs
            function filterData(elem = null, text){
                let arrDate = new Array();
                $.each( filterDate, function( key, value ) {
                    arrDate.push(filterDate[key]['key']);
                });
                $.ajax({
                    url: URL_TOP_PAGE_FILTER,
                    type:"GET",
                    data: {
                        "filterDate": arrDate,
                        "page": page,
                        "order": orderBy,
                        'category_child': CategoryChild,
                        'category_parent': CategoryParent,
                        'city_id': cityId,
                        'route_id': routeId,
                        'area_id': areaId
                    },
                    cache:false,
                    beforeSend: function() {
                        if(elem != null) {
                            $(`${elem}`).html('<i class="fas fa-spinner fa-pulse"></i>');
                        }
                    },
                    success:function(data){
                        if(!data.hasNext){
                            $('#show-more .button-show-more').hide();
                        }else {
                            $('#show-more .button-show-more').show();
                        }
                        $("#pills-home").html(data.body);
                        $('.number-of-job').text(data.total + '件');
                        $('.number-searched').text(data.total + '件');
                    },error:function(){
                        console.log('error');
                    }
                }); //end of ajax
            }

            // event show more job
            $('body').on('click', '#show-more', function () {
                page++;
                let arrDate = new Array();
                $.each( filterDate, function( key, value ) {
                    arrDate.push(filterDate[key]['key']);
                });
                $.ajax({
                    url: URL_TOP_PAGE_FILTER,
                    type:"GET",
                    data: {
                        "filterDate": arrDate,
                        "page": page,
                        "order": orderBy,
                        'category_child': CategoryChild,
                        'category_parent': CategoryParent,
                        'city_id': cityId,
                        'route_id': routeId,
                        'area_id': areaId
                    },
                    cache:false,
                    beforeSend: function() {
                        $(`#show-more .button-show-more`).html('<i class="fas fa-spinner fa-pulse"></i>');
                    },
                    success:function(data){
                        setTimeout(function() {
                            $("#pills-home").html(data.body);
                            $(`#show-more .button-show-more`).html('もっと見る');
                            if(!data.hasNext){
                                $('#show-more .button-show-more').hide();
                            }else {
                                $('#show-more .button-show-more').show();
                            }
                            $('.number-of-job').text(data.total + '件');
                            $('.number-searched').text(data.total + '件');
                        }, 1000);
                    },error:function(){
                        console.log('error');
                    }
                }); //end of ajax
            });

            // ajax favorite
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

            // sort job tab
            $('body').on('click', '.sort-tab', function () {
                orderBy = $(this).data('sort');
                page = 1;
                filterData();
            });

            // check all checkbox
            $('body').on('click',".check-all-item",function(){
                $(this).parents('.item-content').find('input[type=checkbox]').not(this).prop('checked', this.checked);
            });

            // select checkbox categories
            $('#filter-item-subcategories').on('click',".check-item",function(){
                let lenchk = $(this).closest('.list-sub-item').find(':checkbox');
                let lenchkChecked = $(this).closest('.list-sub-item').find(':checkbox:checked');

                //if all siblings are checked, check its parent checkbox
                if (lenchk.length == lenchkChecked.length) {
                    $(this).closest('.item-content').find('.check-all-item').prop('checked', true);
                }else{
                    $(this).closest('.item-content').find('.check-all-item').prop('checked', false);
                }
            });

            // click submit filter categories
            $('body').on('click',".btn-filter-categories",function(){
                getArrayCategoryId();
                page = 1;
                filterData();
                $('#modal-category-filter').modal('hide');
            });

            // // select checkbox route
            // $('#filter-station-route').on('click',".item-route",function(){
            //     filterArea = [];
            //     $('input[name="checkbox-route"]:checked').each(function() {
            //         filterArea.push(this.value);
            //     });
            //     console.log(filterArea);
            // });
            $('body').on('click',".btn-filter-station",function(){
                getArrayStationsId();
                page = 1;
                filterData();
                $('#modal-area-filter').modal('hide');
            });

            // get all categories id
            function getArrayCategoryId() {
                CategoryParent = [];
                CategoryChild = [];
                $('.category-parent.item-content-active').each(function() {
                    CategoryParent.push($(this).data('id'));
                });
                for (let id of CategoryParent) {
                    if($(`#filter-item-sub${id}`).find('input[name="checkbox-category"]:checked').length > 0){
                        CategoryParent = CategoryParent.filter(item => item !== id)
                    }
                }
                $('input[name="checkbox-category"]:checked').each(function() {
                    CategoryChild.push(this.value);
                });
            }

            // get all route id and area city id
            function getArrayStationsId() {
                areaId = [];
                cityId = [];
                routeId = [];
                $('.item-area.item-content-active').each(function() {
                    areaId.push($(this).data('id'));
                });
                if($(`#filter-item-city`).find('.item-content.item-content-active').length > 0){

                    $('#filter-item-city .item-content.item-content-active').each(function() {
                        cityId.push($(this).data('id'));
                    });
                    console.log(cityId)
                    for (let id of cityId) {
                        if($(`#accordion-item-${id}`).find('input[name="checkbox-route"]:checked').length > 0){
                            cityId = cityId.filter(item => item !== id)
                        }
                    }
                    $('input[name="checkbox-route"]:checked').each(function() {
                        routeId.push(this.value);
                    });
                }else {
                    $('#filter-item-city .item-content').each(function() {
                        cityId.push($(this).data('id'));
                    });
                }

            }
        });
    </script>
@endpush
