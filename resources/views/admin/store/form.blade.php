@extends('admin.layouts.admin')

@section('title')
    Store
@endsection

@section('content')

    <div class="content-wrapper">
        <?php $keyThumbnail = isset($store) ? 'edit' : 'add'; ?>
        @include('admin.partials.content-header',['name' => 'Store ','key'=> $keyThumbnail ])
        <!-- Content Header (Page header) -->
        <div class="content my-2">
            <div class="card card-warning">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                           role="tab" aria-controls="nav-home" aria-selected="true">Genneral information</a>
                        <a class="nav-item nav-link <?php echo isset($store) ? '' : 'disabled' ?>"
                           id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                           role="tab" aria-controls="nav-profile" aria-selected="false"> Login account</a>
                    </div>
                </nav>
                <div class="tab-content nav-tabContent-company" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="tab-content" id="nav-tabContent">
                            @yield('form')
                        </div>
                    </div>
                    {{-- tab list user of store--}}
                    @if(isset($store))
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="content">
                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4 p-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3 float-right">
                                                <div class="register" data-target="#register">
                                                    <a href="" class="btn-add-new open-model-user"
                                                       data-toggle="modal"
                                                       data-target="#register"> <i class="fas fa-plus"></i></a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 float-right">
                                            <table id="table-list-company" class="table table-bordered" role="grid"
                                                   aria-describedby="example2_info">
                                                <thead class="thead-light">
                                                <tr role="row">
                                                    <th class="sorting sorting_asc">ID</th>
                                                    <th class="sorting">Name</th>
                                                    <th class="sorting">Email</th>
                                                    <th class="sorting">Status</th>
                                                    <th class="sorting">Created date</th>
                                                    <th class="sorting"></th>

                                                </tr>
                                                </thead>
                                                <tbody id="tbody-list-user">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
    <style>
        .select2-container--default .select2-selection--multiple {
            overflow-x: hidden;
        }
        .select2-container--default .select2-results>.select2-results__options {
            display: block;
        }
    </style>
    </div>
    @if(isset($store))
        @include('admin.modal.store.register')
        {{-- modal comfirm delete user--}}
        @include('admin.modal.store.popup-confirm-delete-user')
    @endif
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        fetchDataUser();
        $('#city').change(function () {
            let url = '{{ route('company.getDistrict') }}'
            let name = $(this).val()
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    name: name,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function (res) {
                    $('#district').empty()
                    $('#district').append('<option value="" disabled selected></option>')
                    $.each(res, function (index, value) {
                        $('#district').append('<option value="' + value['katakana_name'] + '">' + value['katakana_name'] + '</option>')
                    })
                },
                error: function (res) {
                    console.log(res)
                }

            })
        })

        $(document).ready(function () {

            $('.js-select2').select2({
                placeholder: "Area"
            });
        });

        function fetchDataUser() {
            let id = '{{ $store->id ?? '' }}';
            $.ajax({
                url: '{{ route('store.user.list') }}',
                method: "GET",
                data: {
                    id
                },
                success: function (data) {
                    $('#tbody-list-user').html(data.body);
                }
            });
        }

        $('body').on('click', '.btn-delete-user', function () {
            let id = $(this).data('id');
            $('#input-confirm-id').val(id);
        });

    </script>
@endpush
