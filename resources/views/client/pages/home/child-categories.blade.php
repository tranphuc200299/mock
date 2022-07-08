@if($categoriesParent)
    @foreach($categoriesParent as $parent)
        @if(!$parent->children)
            <div class="item-content item-current d-flex align-items-center">
                <input type="checkbox" class="check-all" value="{{$parent->id}}" name="checkbox-category">
                <div class="name">{{ $parent->name }}</div>
                <div class="result">({{ count_jobs_by_category($parent->id, 2) }})</div>
            </div>
        @else
            <div class="item-content" data-browse="dsads">
                <div class="sub-item-all d-flex align-items-center">
                    <input type="checkbox" class="check-all-item" value="{{$parent->id}}" name="checkbox-category" id="input-category-{{$parent->id}}">
                    <label class="name" for="input-category-{{$parent->id}}">{{ $parent->name }}</label>
                    <div class="result">({{ count_jobs_by_category($parent->id, 2) }})</div>
                </div>
                <div class="list-sub-item">
                    @foreach($parent->children as $child)
                        <div class="sub-item d-flex align-items-center">
                            <input type="checkbox" class="check-item" value="{{$child->id}}" name="checkbox-category" id="input-category-{{$child->id}}">
                            <label class="name" for="input-category-{{$child->id}}">{{$child->name}}</label>
                            <div class="result">({{ count_jobs_by_category($child->id, 3) }})</div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endforeach
@endif
