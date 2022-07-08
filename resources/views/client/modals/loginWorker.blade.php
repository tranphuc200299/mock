<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="100" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div>
            <div class="modal-content form-login-worker" >
                <div class="modal-header modal-worker-login-header d-block text-center">
                    <h4 class="modal-title" id="exampleModalLongTitle" >会員登録／ログイン</h4>
                    <button type="button" class="btn-close btn-close-modal-login" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body modal-worker-login-body">
                    <div class="modal-body-login-worker">
                        <label class="telephoneLabel">電話番号</label>
                        <input type="text" placeholder="09012345678(半角)" class="loginInput" name="phone">
                        <small style="color: red" class="error error_phone"></small>
                    </div>
                    <div class="modal-body-login-worker">
                        <label class="telephoneLabel">パスワード</label>
                        <input type="password" placeholder="パスワード" class="loginInput" name="password">
                        <small style="color: red" class="error error_password"></small>
                    </div>
                    <input type="button" class="buttonWorkerLogin" value="ログインする">
                    <div class="forgot-password-worker-modal">パスワードを忘れた方はこちら</div>
                    <div class="horizontal-line-word-modal-login">
                        <span>または</span>
                    </div>
                    <button class="buttonWorkerLoginByLine">
                        <img src="{{ asset('images/icon/LINELOGO.svg') }}" style="margin-right: 10px">
                        LINEでログインする
                    </button>
                </div>
                <div class="modal-footer modal-worker-login-footer">
                    <span>会員登録がまだの方はこちら</span><br>
                    <button class="btn-redirect-register" id="select">会員登録する(無料)</button>
                </div>
            </div>
        </div>


    </div>
</div>
@push('scripts')
    <script>
        $('.btn-redirect-register').on('click', function () {
            location.href = "{{ route('register.worker') }}";
        })
        $('.buttonWorkerLoginByLine').on('click', function() {
            location.href = "{{ route('workerLogin.redirectToLine') }}";
        });

        $('.forgot-password-worker-modal').on('click', function() {
            location.href = "{{ route('worker.forgotPassword') }}";
        });

        $('.buttonWorkerLogin').on('click',function(event) {
            let form = $('.form-login-worker');
            let phone = form.find('input[name="phone"]').val();
            let password = form.find('input[name="password"]').val();

            $.ajax({
                url: '{{ route('worker.login') }}',
                type:"POST",
                data: {
                    phone,
                    password,
                    _token: '{{csrf_token()}}'
                },
                success:function(data){
                    if(data != '') {
                        form.find('.error').hide();
                        $(".error_phone").html(data);
                        $(".error_phone").show(data);
                    } else {
                        location.reload();
                    }
                },error:function(error){
                    form.find('.error').hide();
                    $.each(error.responseJSON.errors, function (key, value) {
                        if (value != null) {
                            $(".error_" + key).html(value[0]);
                            $(".error_" + key).show();
                        }
                    });
                    console.log(error);
                }
            }); //end of ajax
        });
    </script>
@endpush

<style>
    .btn-close-modal-login{
        position: absolute;
        top: 5px;
        right: 10px;
    }
    .horizontal-line-word-modal-login {
        width: 100%;
        text-align: center;
        border-bottom: 1px solid #000;
        line-height: 0.1em;
        margin: 10px 0 20px;
        color: #4B4B4B;
    }

    .horizontal-line-word-modal-login > span {
        background:#fff;
        padding:0 20px;
    }
    .forgot-password-worker-modal {
        color: #004AF8;
        text-decoration: underline;
        text-align: center;
        cursor: pointer;
        margin-bottom: 20px;
    }
    .modal-worker-login-body, .modal-worker-login-header{
        padding: 0px 100px;
        border-bottom: 0px;
    }
    .modal-worker-login-footer {
        padding: 30px 100px;
        margin-bottom: 0px;
        justify-content: center;
    }
    .modal-title {
        margin-left: auto;
    }
    .loginInput {
        width: 100%;
        border: 1px solid #BCBCBC;
        outline: none;
        padding: 7px 15px;
        border-radius: 3px;
    }
    .telephoneLabel {
        margin: 10px 0px;
        letter-spacing: 0px;
        font-weight: normal;
    }
    .modal-body-login-worker {
        margin-bottom: 10px;
    }
    .buttonWorkerLogin {
        color: #0EAFFF;
        box-shadow: 0px 2px 2px #00000029;
        border: 2px solid #0EAFFF;
        width: 100%;
        height: 50px;
        font-size: 16px;
        text-align: center;
        margin: 20px 0px;
        background-color: #FFFFFF;
        border-radius: 10px;
    }
    .buttonWorkerLoginByLine {
        color: #16CA02;
        box-shadow: 0px 2px 2px #00000029;
        border: 2px solid #16CA02;
        width: 100%;
        height: 50px;
        font-size: 16px;
        text-align: center;
        margin: 20px 0px;
        background-color: #FFFFFF;
        border-radius: 10px;
    }
    .btn-redirect-register {
        width: 100%;
        border-radius: 16px;
        height: 50px;
        background-color: #0EAFFF;
        box-shadow: 0px 2px 2px #00000029;
        border: 2px solid #0EAFFF;
        color: #FFFFFF;
    }
    .modal-header {
        margin: 10px 0px;
    }

</style>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="{{asset('js/admin/company.js')}}"></script>

