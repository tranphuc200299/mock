"use strict";

(function(){
    // add csrf for method post
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // event click pagination company
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });

    // event keyup live search company
    $('#searchCompany').on('keyup', function(){
        searchCompany();
    });
    function searchCompany(){
        let keyword = $('#searchCompany').val();
        $.ajax({
            url: URL_COMPANY_SEARCH_PAGINATION,
            type:"GET",
            data: {
                'keyword':keyword },
            success:function(data){
                $("#list-company").html(data.body);
                // $("#company-paginate").hide();
                $("#total-company").html("Total: "+data.company.total);
                console.log(data);
            },error:function(){
                console.log('error');
            }
        }); //end of ajax
    }

    //    upload file
    $('.upload-file-company').on( "change", function() {
        if (!(/\.(xlsx|xls|csv|pdf|docs|jpg|jpeg|png)$/i).test($(this).val())) {
            toastr.error('The file must be a file of type: xlsx,xls,csv,pdf,docs,jpg,jpeg,png');
            $(this).val('');
        }else {
            let form = $(this).parents('.form-upload-file');
            let formData = new FormData(form.get(0));
            let id = form.find("input[name='id']").val();
            $.ajax({
                url: URL_FILE_UPLOAD,
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
                        fetchDataFileOfCompany(id);
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
        }
    });

    // Ajax create user company and Ajax edit user company
    $('.btn-model-user').on('click',function(event) {
        event.preventDefault();
        let checkAjax = $('#form-create-user_company input[name="checkAjax"]').val();
        console.log(typeof checkAjax);
        if (checkAjax == 'create'){
            let form = $('#form-create-user_company');
            let name = form.find('input[name="name"]').val();
            let email = form.find('input[name="email"]').val();
            let password = form.find('input[name="password"]').val();
            let status = form.find('input[name="status"]:checked').val();
            let companyId = form.find('input[name="companyId"]').val();
            $.ajax({
                url: URL_CREATE_USER_COMPANY,
                type:"POST",
                data: {
                    name,
                    email,
                    password,
                    status,
                    companyId
                },
                beforeSend: function() {
                    form.find('.btn-model-user').html('<i class="fas fa-spinner fa-pulse"></i>');
                },
                success:function(data){
                    setTimeout(function() {
                        form.find('.btn-model-user').html('SAVE');
                        $('#register').modal('hide');
                        toastr.success('Create Account Success');
                        fetchDataUser();
                    }, 1000);
                    console.log(data);
                },error:function(error){
                    setTimeout(function() {
                        form.find('.btn-model-user').html('SAVE');
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
        }else {
            let form = $('#form-create-user_company');
            let name = form.find('input[name="name"]').val();
            let email = form.find('input[name="email"]').val();
            let password = form.find('input[name="password"]').val();
            let status = form.find('input[name="status"]:checked').val();
            let id = form.find('input[name="userId"]').val();
            $.ajax({
                url: URL_UPDATE_USER_COMPANY,
                type:"POST",
                data: {
                    id,
                    name,
                    email,
                    password,
                    status,
                },
                beforeSend: function() {
                    form.find('.btn-model-user').html('<i class="fas fa-spinner fa-pulse"></i>');
                },
                success:function(data){
                    setTimeout(function() {
                        form.find('.btn-model-user').html('UPDATE');
                        $('#register').modal('hide');
                        toastr.success('Update Account Success');
                        fetchDataUser();
                    }, 1000);
                },error:function(error){
                    setTimeout(function() {
                        form.find('.btn-model-user').html('UPDATE');
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

    // Accept delete user of company
    $(document).on('click','#btn-confirm-delete',function(event) {
        let id = $('#input-confirm-id').val();
        $.ajax({
            url: URL_DELETE_USER_COMPANY,
            type:"POST",
            data:{
                id
            },
            beforeSend: function() {
                $('#btn-confirm-delete').html('<i class="fas fa-spinner fa-pulse"></i>');
            },
            success:function(data){
                setTimeout(function() {
                    $('#btn-confirm-delete').html('Delete');
                    $('#modal_confirm_delete_user').modal('hide');
                    toastr.success('Delete Account Success');
                    fetchDataUser();
                }, 1000);
            },error:function(error){
                $('#btn-confirm-delete').html('Delete');
                toastr.error(error);
                console.log(error);
            }
        }); //end of ajax
    });

    // get file after upload
    function fetchDataFileOfCompany(id){
        console.log(id);
        $.ajax({
            url: URL_GET_FILE_UPLOAD_COMPANY,
            type:"GET",
            data: {id},
            success:function(data){
                $(`#dropdown-file-upload${id}`).html(data.body);
            },error:function(){
                console.log('error');
            }
        }); //end of ajax
    }




}());
