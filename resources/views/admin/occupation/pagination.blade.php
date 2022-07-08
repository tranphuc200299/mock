<div class="row">
    @if (!empty($occupations) && $occupations->total())
        @foreach ($occupations as $Key => $item)
            <div class="group__wap col-12 col-md-6 d-flex mt-2">
                <div class="col-12 col-md-6 occupation-img">
                    <img src="{{ asset(get_image_occupation_by_id($item->id)[0]->path) }}" alt="error"
                        class="image_occupation">
                </div>
                <div class="occupation-content col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                    <p class="occupaion-title ml-2 mt-2">
                        <b> {{ $item->title }}</b>
                    </p>
                    <p class="occupaion-description ml-2 mt-2">
                        {{ $item->description }}
                    </p>
                    <div class="occupation-action mt-3">
                        <button class="delete__button deletebtn btn-delete ml-1" data-toggle="modal"
                            data-target="#modal_delete" value="{{ $item->id }}">X</button>
                        <a class="edit__button btn-edit ml-1" href="{{ route('occupation.edit', [$item->id]) }}">
                            <i class="fas fa-pen"></i>
                        </a>
                        <a class="create__button btn btn-light ml-1"
                            href="{{ route('job.create',[$item->id]) }}">
                            CREATE JOB
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
</div>
        @else
            <div class="col-sm-12 col-md-12 text-center">
                <p>No data.</p>
            </div>
        @endif
            <div class="row mt-3">
                <div class="col-sm-12 col-md-5">
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers">
                        {!! $occupations->links() !!}
                    </div>
                </div>
            </div>
