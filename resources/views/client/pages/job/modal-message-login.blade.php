<!-- Modal -->
<div class="modal fade" id="message_login_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div>応募にはログインは必要です。今すぐ
                    <a href="javascript:void(0)" data-bs-toggle="modal"
                       data-bs-target="#loginModal" class="modal-login">ログイン</a>
                    アカウントをお持ちでない方は
                    <a href="{{ route('register.worker') }}">会員登録</a></div>
                <button type="button" class="btn-close btn-close-modal-custom" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-close-modal-custom{
        border: solid 1px #000000;
        border-radius: 50%;
        font-size: 10px;
        padding: 6px;
        position: absolute;
        top: -8px;
        right: -9px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #000;
        font-weight: 700;
        background-color: #fff;
    }
</style>
<script>
    $('body').on('click', '.modal-login', function () {
        $('#message_login_modal').modal('hide');
    })
</script>
