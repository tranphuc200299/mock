@extends('admin.layouts.admin')

@section('title')
    List store
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 p-3">
                <div class="d-flex justify-content-between mb-3">
                    <h3 class="d-inline-block">List store</h3>
                    <a href="{{ route('store.create') }}" class="btn-add-new"><i class="fas fa-plus"></i></a>
                </div>
                <div class="mb-3">
                    <div class="form-group w-25">
                        <input class="form-control" type="text" name="keyword" id="searchStore" placeholder="Search by keyword">
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span id="total-store">Total: {{ $store->total() }} </span>
                </div>
                <div id="list-store">
                    <div class="row">
                        <div class="col-sm-12 wow fadeInUp">
                            <table id="table-list-company" class="table table-bordered" role="grid" aria-describedby="example2_info">
                                <thead class="thead-light">
                                    <tr role="row">
                                        <th class="sorting sorting_asc">ID</th>
                                        <th class="sorting" >Store name</th>
                                        <th class="sorting" >Person in change</th>
                                        <th class="sorting" >Address</th>
                                        <th class="sorting" >Status</th>
                                        <th class="sorting" >Created date</th>
                                        <th class="sorting" ></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($store as $item)
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $item->id }}</td>
                                        <td>{{ $item->store_name }}</td>
                                        <td>
                                            Name: {{ $item->person_in_charge_name }}
                                            <br>
                                            Phone: {{ $item->person_in_charge_phone_number }}
                                            <br>
                                            Email: {{ $item->person_in_charge_email }}
                                        </td>
                                        <td>{{ $item->address }}</td>
                                        <td>
                                            @if($item->status)
                                                Enable
                                            @else
                                                Disable
                                            @endif
                                        </td>
                                        <td>
                                            {{ $item->created_at  }}
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-edit" href="{{ route('store.edit', [$item->id]) }}">
                                                    <i class="fas fa-pen"></i></a>
                                                <button class="btn btn-delete btn-delete-store ml-2" data-id="{{ $item->id }}"
                                                        data-toggle="modal"
                                                        data-target="#modal_confirm_delete_store"
                                                >
                                                    <i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="company-paginate">
                                {!! $store->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    modal message canot delete store--}}

@include('admin.modal.store.popup-confirm-delete-store')

@endsection
@push('scripts')
    <script>
        // fetch data pagination store
        function fetch_data(page) {
            let keyword = $('#searchStore').val();
            $.ajax({
                url: '{{ route('store.index') }}' + "?page=" + page,
                data: {
                    'keyword': keyword
                },
                success: function(data) {
                    $("#list-store").html(data.body);
                }
            });
        }

        $('#searchStore').on('keyup', function(){
            search();
        });
        function search(){
            let keyword = $('#searchStore').val();
            $.ajax({
                url: '{{ route('store.index') }}',
                type:"GET",
                data: {
                    'keyword':keyword
                },
                success:function(data){
                    $("#list-store").html(data.body);
                    $("#total-store").html("Total: "+data.store.total);
                }
            }); //end of ajax
        }

        $('body').on('click', '.btn-delete-store', function () {
            let id = $(this).data('id');
            $('#input-confirm-store-id').val(id);
        });

        $(document).on('click','#btn-confirm-delete-store',function(event) {
            let id = $('#input-confirm-store-id').val();
            let url = '{{ route("store.delete", ":id") }}';
            url = url.replace(':id', id);
            location.href = url;
        });
    </script>
@endpush

