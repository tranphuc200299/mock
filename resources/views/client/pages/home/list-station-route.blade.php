@if($city->count())
    @foreach($city as $item)
        <h2 class="accordion-header item-content" id="station-{{ $item->id }}">
            <button class="accordion-button collapsed" type="button"
                    data-bs-toggle="collapse" data-bs-target="#route-{{ $item->id }}"
                    aria-expanded="false" aria-controls="station-{{ $item->id }}">
                {{ $item->name }}
            </button>
        </h2>
        <div id="route-{{ $item->id }}" class="accordion-collapse collapse" aria-labelledby="station-{{ $item->id }}"
             data-bs-parent="#filter-station-route">
            <div class="accordion-body">
                @foreach($item->children as $route)
                    <div class="filter-route d-flex align-items-center mb-1">
                        <input type="checkbox" class="item-route" id="item-route-{{ $route->id }}"
                               value="{{ $route->id }}" name="checkbox-route">
                        <label for="item-route-{{ $route->id }}">{{ $route->name }}</label>
                        <div class="item-result">
                            {{ count_jobs_by_station($route->id, 3) }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
@endif
