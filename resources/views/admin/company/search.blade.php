

<div class="row">
    <div class="col-sm-12 wow fadeInUp">
        <table id="table-list-company" class="table table-bordered" role="grid" aria-describedby="example2_info">
            <thead class="thead-light">
            <tr role="row">
                <th class="sorting sorting_asc">ID</th>
                <th class="sorting" >Company name</th>
                <th class="sorting" >HP URL</th>
                <th class="sorting" >Contact infor</th>
                <th class="sorting" >Adress</th>
                <th class="sorting" >Status</th>
                <th class="sorting" >Created date</th>
                <th class="sorting" ></th>
                <th class="sorting" >File uploaded</th>
            </tr>
            </thead>
            <tbody>
            @if(count($company) <= 0)
                <tr class="odd wow fadeInUp">
                    <td colspan="4">No data.</td>
                </tr>
            @else
                @foreach($company as $item)
                    <tr class="odd wow fadeInUp">
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
                                <div class="dropdown-menu dropdown-custom">
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

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //    upload file
        $('.upload-file-company').on( "change", function() {
            let form = $(this).parents('.form-upload-file');
            let formData = new FormData(form.get(0));
            let url = '{{ route('file.upload') }}';
            $.ajax({
                url: url,
                type:"POST",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    form.find('.btn-upload').html('<i class="fas fa-spinner fa-pulse"></i>');
                },
                success:function(data){
                    setTimeout(function() {
                        form.find('.btn-upload').html('<i class="fas fa-upload"></i>');
                        toastr.success('File upload successful');
                    }, 1000);
                    console.log(data);
                },error:function(error){
                    form.find('.btn-upload').html('<i class="fas fa-upload"></i>');
                    toastr.error(error.responseJSON.errors.file[0]);
                    console.log(error.responseJSON.errors.file[0]);
                }
            }); //end of ajax
        });

    });
</script>
