<div class="modal fade" id="modal-area-filter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header modal__header">
                <h5 class="modal-title modal__title">駅名から絞る</h5>
                <div class="d-flex align-items-center">
                    <div class="result">
                        <p class="mb-0">のお仕事
                            <span class="count-result">30</span>
                            件
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body filter-body">
                <div class="row">
                    <div class="col-12 col-xl-4 filter-box">
                        <label for="">Area</label>
                        <div class="filter-item">
                            <div class="item-content d-flex align-items-center item-area" data-id="49">
                                <div class="name">關東</div>
                                <div class="item-result">{{ count_jobs_by_station(49, 1) }}</div>
                                <div class="item-active">設定中</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4 filter-box">
                        <label for="">City</label>
                        <div class="filter-item ">
                            <div id="filter-item-city" style="display: none">
                                <div class="item-content d-flex align-items-center" data-id="56">
                                    <div class="name">東京</div>
                                    <div class="item-result">{{ count_jobs_by_station(56, 2) }}</div>
                                    <div class="item-active">設定中</div>
                                </div>
                                <div class="item-content d-flex align-items-center" data-id="53">
                                    <div class="name">神奈川</div>
                                    <div class="item-result">{{ count_jobs_by_station(53, 2) }}</div>
                                    <div class="item-active">設定中</div>
                                </div>
                                <div class="item-content d-flex align-items-center" data-id="50">
                                    <div class="name">千葉</div>
                                    <div class="item-result">({{ count_jobs_by_station(50, 2) }}</div>
                                    <div class="item-active">設定中</div>
                                </div>
                                <div class="item-content d-flex align-items-center" data-id="54">
                                    <div class="name">埼玉</div>
                                    <div class="item-result">{{ count_jobs_by_station(54, 2) }}</div>
                                    <div class="item-active">設定中</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4 filter-box">
                        <label for="">Station-Route</label>
                        <div class="filter-item">
                            <div class="accordion accordion-flush" id="filter-station-route">
                                <div class="accordion-item">
                                    <div class="block-station" id="accordion-item-56">
                                    </div>
                                    <div class="block-station" id="accordion-item-53">
                                    </div>
                                    <div class="block-station" id="accordion-item-50">
                                    </div>
                                    <div class="block-station" id="accordion-item-54">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="btn-action text-center mt-3">
                    <button class="btn btn-success btn-filter btn-filter-station">
                        求人詳細を見る
                    </button>
                    <p class="mb-0 clear-filter reset-filter">設定をクリア</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let arrCity = new Array();
    $('#filter-item-city').on('click', '.item-content', function () {
        $(this).toggleClass("item-content-active");
        $(this).find('.item-active').toggle();
        let id = $(this).data('id');
        if($(this).hasClass('item-content-active')){
            arrCity.push(id);
        }else {
            arrCity = arrCity.filter(item => item !== $(this).data('id'));
        }

        $.ajax({
            url: '{{ route('get.station.route') }}',
            type:"GET",
            data: {
                "city": arrCity,
                "id": id
            },
            cache:false,
            success:function(data){
                $(`#accordion-item-${id}`).html(data.body);
            },error:function(){
                console.log('error');
            }
        }); //end of ajax
    });

    $('.item-area').click(function () {
        $(this).toggleClass("item-content-active");
        $(this).find('.item-active').toggle();
        $('#filter-item-city').toggle();
    });

    $('#modal-area-filter').on('click','.reset-filter', function () {
        $('.item-area').removeClass('item-content-active');
        $('.item-area').find('.item-active').hide();
        $('#filter-item-city .item-content').removeClass('item-content-active');
        $('#filter-item-city .item-content').find('.item-active').hide();
        $('#filter-item-city').hide();
        $('.block-station').html('');
    });
</script>
