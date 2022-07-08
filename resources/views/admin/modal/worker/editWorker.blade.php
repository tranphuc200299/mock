<!-- Modal -->
<div class="modal fade" id="editWorker" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body" style="padding: 2rem">
                <input type="hidden" id="idWorker">
                <div class="row" style="margin-bottom: 30px">
                    <div class="col-5">
                        <h3 class="modal-title">Detail <span class="worker_name"></span></h3>
                    </div>
                    <div class="col-7 d-flex justify-content-end">
                        <button type="button" class="close_btn" data-dismiss="modal">CLOSE</button>
                        <button type="button" class="edit_btn" id="btn-edit-worker">EDIT</button>
                    </div>
                </div>
                <div class="row confirm-image-occupation">
                    <div class="col-6 mb-2">
                        <div>General information</div><br>
                        <div class="wrap-detail-img">
                            <img class="view-detail-img" src="{{ asset('upload/images/3SMGzjnrnqc2ZFAgHHUl.brunette-sexy-girl-hinh-nen-2048x1152_49.jpg') }}"/>
                        </div>
                    </div>
                    <div class="col-6">
                        <lable>Status confirmation information</lable>
                        <div class="d-flex" style="align-items: center">
                            <input type="radio" id="worker_status_enable" name="status_login" value="1" disabled>
                            <label for="enable" class="label__radio__input">Enable</label><br>
                            <input type="radio" id="worker_status_disable" name="status_login" value="0" disabled>
                            <label for="disable" class="label__radio__input">Disable</label><br>
                        </div>
                        <div class="edit__worker__input">
                            <input type="text" name="name" class="input__worker input__worker__name" disabled>
                            <span class="label__input">Name</span>
                        </div>
                        <div class="edit__worker__input">
                            <input type="text" name="name_kana" class="input__worker input__worker__kana__name" disabled    >
                            <span class="label__input">Name (kana)</span>
                        </div>
                        <div class="edit__worker__input">
                            <div class="d-flex justify-content-between  w-75" style="align-items: center">
                                <div>
                                    <input type="radio" id="male" name="gender" value="male" disabled>
                                    <label for="male" class="mb-0">Male</label>
                                </div>
                                <div>
                                    <input type="radio" id="female" name="gender" value="female" disabled>
                                    <label for="female" class="mb-0">Female</label>
                                </div>
                                <div>
                                    <input type="radio" id="other" name="gender" value="other" disabled>
                                    <label for="other" class="mb-0">Other</label>
                                </div>
                            </div>
                            <span class="label__input">Gender</span>
                        </div>
                        <div class="edit__worker__input">
                            <input type="text" name="birthday" class="input__worker input__worker__birthday" disabled>
                            <span class="label__input">Birthday</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="edit__worker__input">
                            <div class="d-flex justify-content-between w-75" style="align-items: center">
                                <div>
                                    <input type="radio" id="line" name="register_via" value="line" disabled>
                                    <label for="line" class="mb-0">Line account</label>
                                </div>
                                <div>
                                    <input type="radio" id="phone" name="register_via" value="phone" disabled>
                                    <label for="phone" class="mb-0">Phone number</label>
                                </div>
                            </div>
                            <span class="label__input">Register via</span>
                        </div>
                        <div class="edit__worker__input">
                            <input type="text" name="birthday" class="input__worker input__worker__email" disabled>
                            <span class="label__input">Email</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="edit__worker__input">
                            <select class="js-select2 w-100" name="area[]"
                                    multiple="multiple" id="worker-area"
                                    style="position: relative;" disabled>
                            </select>
                            <span class="label__input">Area want to work</span>
                        </div>
                        <div class="edit__worker__input">
                            <input type="text" name="birthday" class="input__worker input__worker__phone" disabled>
                            <span class="label__input">Phone number</span>
                        </div>
                    </div>
                </div>
                <p class="label-column">Certificate</p>
                <div class="row degree-image">
{{--                    <div class="col-3">--}}
{{--                        <img class="certificate__image" src="{{ asset('upload/images/3SMGzjnrnqc2ZFAgHHUl.brunette-sexy-girl-hinh-nen-2048x1152_49.jpg') }}"/>--}}
{{--                    </div>--}}
                </div>
                <p class="label-column">Personal information</p>
                <div class="row" style="margin-bottom: 10px">
                    <div class="col-6 d-flex">
                        <span>Front</span>
                        <img class="passport__image passport__image__front" src=""/>
                        <div class="d-flex justify-content-end flex-column">
{{--                            <span class="text-blue">Approve</span>--}}
{{--                            <span class="text-red">Reject</span>--}}
                        </div>
                    </div>
                    <div class="col-6 d-flex">
                        <span>Back</span>
                        <img class="passport__image passport__image__back" src="{{ asset('upload/images/3SMGzjnrnqc2ZFAgHHUl.brunette-sexy-girl-hinh-nen-2048x1152_49.jpg') }}"/>
                        <div class="d-flex justify-content-end flex-column">
                            <span class="text-blue approve_passport" data-dismiss="modal" style="cursor: pointer">
                                Approve
                            </span>
                            <span class="text-red reject_passport" data-toggle="modal"
                                    data-target="#modal_confirm_reject_worker" data-id="" style="cursor: pointer">Reject</span>
                        </div>
                    </div>
                </div>
                <p class="label-column">Status of confirmation information</p>
                <div class="d-flex" style="align-items: center">
                    <input type="radio" id="not_upload" name="status_profile" value="3" disabled>
                    <label for="not_upload" class="label__radio__input">Not upload</label><br>
                    <input type="radio" id="waiting_approve" name="status_profile" value="2" disabled>
                    <label for="waiting_approve" class="label__radio__input">Waiting approve</label><br>
                    <input type="radio" id="approved" name="status_profile" value="0" disabled>
                    <label for="approved" class="label__radio__input">Approved</label><br>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    input[type="radio"]:disabled {
        -webkit-appearance: none;
        display: inline-block;
        width: 12px;
        height: 12px;
        padding: 0px;
        background-clip: content-box;
        border: 2px solid grey;
        background-color: white;
        border-radius: 50%;
    }

    input[type="radio"]:checked {
        background-color: #0873fa;
        border: 2px solid #1b7efa;
        padding: 1px;
    }

    .close_btn, .edit_btn {
        width: 150px;
        text-align: center;
        border: none;
        border-radius: 5px;
        color: #fff;
        padding: 5px 0px;
    }
    .close_btn {
        background-color: #aaa;
        margin-right: 10px;
    }
    .edit_btn {
        background-color: #169bd5;
    }
    .select2-selection__choice__display {
        font-size: 12px;
    }
    .select2-selection__choice {
        margin: 0px !important;
        border: 0px !important;
    }
    .select2-selection, .select2-selection--multiple {
        border: none !important;
        outline: none !important;
        background-color: transparent !important;
    }
    .select2-selection__choice__remove {

    }
    .edit__worker__input {
        position: relative;
        margin: 10px 0px;
        height:60px;
        width: 100%;
        border: 1px solid #c0c0c0;
        border-radius: 5px;
        padding-top: 30px;
        padding-left: 10px;
    }

    .label__input {
        position: absolute;
        top: 2px;
        left: 10px;
        color: grey;
    }

    .input__worker {
        outline: none;
        width: 100%;
        border: none;
    }

    .passport__image {
        width: 200px;
        margin: 0px 10px;
    }

    .label__radio__input {
        margin: 0px 35px 0px 10px
    }

    .certificate__image {
        width: 100%;
        border: 8px solid #ccc;
        margin: 0px 5px;
    }

    .modal-title{
        color: #000000;
    }

    .label-column{
        min-width: 8rem;
        margin-top: 5px;
        font-weight: 600;
    }

    img.view-detail-img {
        width: 100%;
        height: 250px;
    }
    .wrap-detail-img{
        border: 8px solid #ccc;
    }
    label {
        font-weight: 500 !important;
    }
    @media (min-width: 900px){
        .modal-dialog {
            max-width: 750px;
            margin: 1.75rem auto;
        }
    }
</style>
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.js-select2').select2();
        });

        $('#btn-edit-worker').on('click', function() {
            let id = $('#idWorker').val();
            let url = '{{ route("admin.worker.edit", ":id") }}';
            url = url.replace(':id', id);
            location.href = url;
        })

        $('.approve_passport').on('click', function() {
            let status = 0;
            let id = $('#idWorker').val();
            let url = '{{ route("admin.worker.approveProfile", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    status
                },
                success:function(data){
                    fetch_data();
                    toastr.success('update status worker success');
                },error:function(error){
                    console.log(error);
                }
            });
        });
    </script>
@endpush

