@extends('admin.layouts.admin')

@section('title')
    List company
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 p-3">
                <div class="d-flex justify-content-between mb-3">
                    <h3 class="d-inline-block">List company</h3>
                    <a href="{{ route('company.create') }}" class="btn-add-new"><i class="fas fa-plus"></i></a>
                </div>
                <div class="mb-3">
                    <div class="form-group w-25">
                        <input class="form-control" type="text" name="keyword" id="searchCompany" placeholder="Search by keyword">
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span id="total-company">Total: {{ $company->total() }} </span>
                    <a href="{{ route('export-company') }}">Export list company</a>
                </div>
                <div id="list-company">
                    <div class="row">
                        <div class="col-sm-12 wow fadeInUp">
                            <table id="table-list-company" class="table table-bordered" role="grid" aria-describedby="example2_info">
                                <thead class="thead-light">
                                <tr role="row">
                                    <th class="sorting sorting_asc">ID</th>
                                    <th class="sorting" >Company name</th>
                                    <th class="sorting" >HP URL</th>
                                    <th class="sorting" >Contact infor</th>
                                    <th class="sorting" >Address</th>
                                    <th class="sorting" >Status</th>
                                    <th class="sorting" >Created date</th>
                                    <th class="sorting" ></th>
                                    <th class="sorting" >File uploaded</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($company) && $company->count())
                                    @foreach($company as $item)
                                    <tr class="odd">
                                        <td class="dtr-control sorting_1" tabindex="0">{{ $item->id }}</td>
                                        <td>{{ $item->company_name }}</td>
                                        <td> <a href="{{ $item->hp_url }}" target="_blank">{{ $item->hp_url }} </a></td>
                                        <td>
                                            Name: {{ $item->contact_name }}
                                            <br>
                                            Phone: {{ $item->phone }}
                                            <br>
                                            Email: {{ $item->email }}
                                        </td>
                                        <td>{{ $item->city }} {{ $item->district }} {{ $item->building }} {{ $item->room }}</td>
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
                                                <a class="btn btn-edit" href="{{ route('company.edit', [$item->id]) }}">
                                                    <i class="fas fa-pen"></i></a>
                                                <button class="btn btn-delete ml-2" data-toggle="modal"
                                                        data-target="#modal_cannot_delete">
                                                    <i class="far fa-trash-alt"></i></button>
                                            </div>
                                        </td>
                                        <td>
                                            <form action="{{ route('file.upload') }}" method="post" class="form-upload-file" enctype="multipart/form-data">
                                                @csrf
                                                <div class="upload-btn-wrapper">
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <input type="file" name="file" id="input-file{{ $item->id }}" class="form-control-file upload-file-company">
                                                    <label class="btn btn-upload" for="input-file{{ $item->id }}"><i class="fas fa-upload"></i></label>
                                                </div>
                                            </form>

                                            @php
                                                $fileUploaded = get_file_uploaded_company_by_id($item->id);
                                            @endphp
                                            <div class="dropdown">
                                                <button type="button" class="dropdown-toggle btn-dropdown" data-toggle="dropdown">
                                                    File uploaded
                                                </button>
                                                <div class="dropdown-menu dropdown-custom" id="dropdown-file-upload{{ $item->id }}">
                                                    @if(count($fileUploaded)>0)
                                                    @foreach($fileUploaded as $file)
                                                        <a class="dropdown-item" href="{{ URL::asset($file->path) }}" download>
                                                        {{ $file->title }}</a>
                                                    @endforeach
                                                    @else
                                                        <a class="dropdown-item" href="javascript:void(0)">There are no files</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr class="odd wow fadeInUp">
                                        <td colspan="9">No data.</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-5">

                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers" id="company-paginate">
                                {!! $company->links() !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

{{--    modal message canot delete copany--}}
    @include('admin.modal.company.popup-cannot-delete')

@endsection
@push('scripts')
    <script>
        // fetch data pagination company
        function fetch_data(page) {
            let keyword = $('#searchCompany').val();
            $.ajax({
                url: URL_COMPANY_SEARCH_PAGINATION + "?page=" + page,
                data: {
                    'keyword':keyword },
                success: function(data) {
                    $("#list-company").html(data.body);
                }
            });
        }
    </script>
@endpush

