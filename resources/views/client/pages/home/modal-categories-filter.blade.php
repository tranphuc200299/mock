@php
    $categoriesLevel1 = get_categories_by_parent([0],['children.children']);
@endphp
<div class="modal fade" id="modal-category-filter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header modal__header">
                <h5 class="modal-title modal__title">駅名から絞る</h5>
                <div class="d-flex align-items-center">
                    <div class="result">
                        <p class="mb-0">のお仕事
                            <span class="count-result"></span>
                            件
                        </p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body filter-body filter-category-body">
                <div class="row">
                    <div class="col-12 col-xl-7 filter-box">
                        <label for="">分類を選択する</label>
                        <div class="filter-item">
                            @foreach($categoriesLevel1 as $category)
                                <div class="item-content category-parent category-parent{{ $category->id }}" data-id="{{ $category->id }}">
                                    <div class="name-result d-flex align-items-center">
                                        <div class="name">
                                            {{ $category->name }}
                                        </div>
                                        <div class="item-result">({{ count_jobs_by_category($category->id, 1) }})</div>
                                        <div class="item-active">設定中</div>
                                    </div>
                                    <div class="description">
                                        {{ $category->description }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 col-xl-5 filter-box">
                        <label for="">分類を選択する</label>
                        <div class="filter-item" id="filter-item-subcategories">
                            @foreach($categoriesLevel1 as $category)
                                <div class="block-item-sub" id="filter-item-sub{{ $category->id }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="btn-action text-center mt-3">
                    <button class="btn btn-success btn-filter btn-filter-categories">
                        求人詳細を見る
                    </button>
                    <a class="mb-0 clear-filter reset-filter">設定をクリア</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var arrCateorirs = new Array();

    $('.filter-category-body').on('click', '.category-parent', function () {
        $(this).toggleClass("item-content-active");
        $(this).find('.item-active').toggle();
        let id = $(this).data('id');
        if($(this).hasClass('item-content-active')){
            arrCateorirs.push(id);
        }else {
            arrCateorirs = arrCateorirs.filter(item => item !== id);
        }
        $.ajax({
            url: '{{ route('get.sub.categories') }}',
            type:"GET",
            data: {
                "categories": arrCateorirs ?? [],
                "id": id
            },
            cache:false,
            success:function(data){
                $(`#filter-item-sub${id}`).html(data.body);
            },error:function(){
                console.log('error');
            }
        }); //end of ajax
    });

    $('#modal-category-filter').on('click','.reset-filter', function () {
        $('.category-parent').removeClass('item-content-active');
        $('.category-parent').find('.item-active').hide();
        $('.block-item-sub').html('');
    });
</script>
