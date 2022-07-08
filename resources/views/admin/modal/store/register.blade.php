<!-- Modal -->
<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" id="form-create-user_store">
            @csrf
            <input type="hidden" name="checkAjax">
            <input type="hidden" name="storeId" value="{{ $store->id }}">
            <input type="hidden" name="userId">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Register User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body modal-register">
                <div class="row">
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg"
                                   placeholder="Register name" name="name">
                            <small style="color: red; display: block" class="error error_name"></small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg"
                                   placeholder="Login Email" name="email">
                            <small style="color: red; display: block" class="error error_email"></small>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-12">
                        <div class="form-group">
                            <div class="form-password-register">
                                <div class="form-password-register-item">
                                    <input type="password" class="form-control register-password"
                                            placeholder="Password" name="password">
                                </div>
                                <div class="icon-show-password">
                                    <i class="fa fa-eye" aria-hidden="true" id="none-eye"></i>
                                    <i class="fa fa-eye-slash" id="show-eye" aria-hidden="true"></i>
                                </div>
                            </div>
                            <small style="color: red" class="error error_password"></small>
                        </div>
                    </div>
                </div>
                <div class="row p-lg-2">
                    <label class="radio-button">
                        <input class="form-check-input" type="radio" name="status" checked="" value="1" id="enableStatusStoreUSer">
                        <label class="form-check-label" for="enableStatusStoreUSer">Enable</label>
                    </label>
                    <label class="radio-button-2">
                        <input class="form-check-input" type="radio" name="status" value="0" id="disableStatusStoreUSer">
                        <label class="form-check-label" for="disableStatusStoreUSer">Disable</label>
                    </label>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                <button type="button" class="btn btn-primary btn-model-user-store btn-create-user">SAVE</button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
     <script>
        $('.icon-show-password').on('click',function (){
            $('#show-eye').toggle()
            $('#none-eye').toggle()
            let input = $(this).parent().find('.form-password-register-item input')
            if(input.attr("type")==='text')
            {
                input.attr("type","password")
            }else{
                input.attr("type","text")
            }
        })

        $('.btn-model-user-store').on('click',function(event) {
            event.preventDefault();
            let checkAjax = $('#form-create-user_store input[name="checkAjax"]').val();

            let form = $('#form-create-user_store');
            let name = form.find('input[name="name"]').val();
            let email = form.find('input[name="email"]').val();
            let password = form.find('input[name="password"]').val();
            let status = form.find('input[name="status"]:checked').val();

            if (checkAjax == 'create'){
                let storeId = form.find('input[name="storeId"]').val();
                $.ajax({
                    url: '{{ route('store.user.add') }}',
                    type:"POST",
                    data: {
                        name,
                        email,
                        password,
                        status,
                        storeId
                    },
                    beforeSend: function() {
                        form.find('.btn-model-user-store').html('<i class="fas fa-spinner fa-pulse"></i>');
                    },
                    success:function(data){
                        setTimeout(function() {
                            form.find('.btn-model-user-store').html('SAVE');
                            $('#register').modal('hide');
                            toastr.success('Create Account Success');
                            fetchDataUser();
                        }, 1000);
                    },error:function(error){
                        setTimeout(function() {
                            form.find('.btn-model-user-store').html('SAVE');
                            form.find('.error').hide();
                            $.each(error.responseJSON.errors, function (key, value) {
                                console.log(value);
                                if (value != null) {
                                    $(".error_" + key).html(value[0]);
                                    $(".error_" + key).show();
                                }
                            });
                        }, 1000);

                        console.log(error);
                    }
                }); //end of ajax
            }else {
                let id = form.find('input[name="userId"]').val();
                $.ajax({
                    url: '{{ route('store.user.update') }}',
                    type:"POST",
                    data: {
                        id,
                        name,
                        email,
                        password,
                        status,
                    },
                    beforeSend: function() {
                        form.find('.btn-model-user-store').html('<i class="fas fa-spinner fa-pulse"></i>');
                    },
                    success:function(data){
                        setTimeout(function() {
                            form.find('.btn-model-user-store').html('UPDATE');
                            $('#register').modal('hide');
                            toastr.success('Update Account Success');
                            fetchDataUser();
                        }, 1000);
                    },error:function(error){
                        setTimeout(function() {
                            form.find('.btn-model-user-store').html('UPDATE');
                            form.find('.error').hide();
                            $.each(error.responseJSON.errors, function (key, value) {
                                if (value != null) {
                                    $(".error_" + key).html(value[0]);
                                    $(".error_" + key).show();
                                }
                            });
                        }, 1000);

                        console.log(error);
                    }
                }); //end of ajax
            }

        });
     </script>
@endpush

