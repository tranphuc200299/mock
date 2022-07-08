@extends('admin.layouts.admin')
@section('title')
    Ocupation
@endsection
@section('content')
    @include('admin.occupation.popup-delete');
    <div class="content-wrapper ">
        @if (Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">
                {{ Session::get('message') }}
            </p>
        @endif
        <!-- Content Header (Page header) -->
        <div class="content my-2">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex ">
                        <div class=" col-12 col-md-6">
                            <h3>List occupation</h3>
                        </div>
                        <span class=" col-12 col-md-6 d-flex justify-content-end ">
                            <a href="{{ route('occupation.create') }}" class="btn-add-new"><i
                                    class="fas fa-plus"></i></a>
                        </span>
                    </div>
                    <span id="total-store">Total: {{ $occupations->total() }} </span>
                    <div id="list-occupation">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------->
    <div id="modal_delete" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header flex-column">
                    <div class="icon-box">
                        <i class="material-icons"><i class="fa fa-times" aria-hidden="true"></i></i>
                    </div>
                    <h4 class="modal-title w-100">Do you want delete Occupation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Do you really want to delete these records? This process cannot be undone.</p>
                </div>
                <form action="{{ route('occupation.delete') }}" method="post">
                    @csrf

                    <input type="hidden" id="id" name="delete_id">

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" id="delete-button" class="btn btn-danger ">Delete</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!------->
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@2.8.2/dist/alpine.min.js"></script>
    <script>
        $("document").ready(function() {
            setTimeout(function() {
                $(".alert-danger").remove();
            }, 3000);

        });
    </script>
@endpush
@push('scripts')
    <script>
        // event click pagination
        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        // fetch data pagination
        function fetch_data(page) {
            $.ajax({
                url: URL_OCCUPATION_INDEX + "?page=" + page,
                method: "GET",
                success: function(data) {
                    $("#list-occupation").html(data.body);
                }
            });
        }
    </script>
    <script>
        // delete
        $(document).on('click', '.deletebtn', function() {
            let id = $(this).val();
            $('#modal_delete').modal('show');
            $('#id').val(id);
        });
    </script>
@endpush
