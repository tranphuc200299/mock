<header class="header">
    <div class="container">
        <div class="content-header content">
            <h1 class="logo mb-0"><a href="{{ URL::to('/') }}" style="text-decoration: none;">LOGO</a></h1>
            <div class="notifications">
                <h2 class="mb-0 message">
                    {{--                    You can work "on a daily basis", "immediately", and "easily".--}}
                    「1日単位で」「すぐに」「簡単に」働ける。
                </h2>
                <div class="login-responsive">
                    <div class="login">
                        <img src="{{asset('images/icon/log-in.png')}}" alt="login-img">
                        <p class="mb-0">ログイン</p>
                    </div>
                </div>
                <div class="keep-list position-relative">
                    <img src="{{asset('images/icon/star.png')}}" alt="icon-star">
                    <img src="{{asset('images/icon/star-blue.png')}}" alt="icon-star" class="star-blue">
                    <label for="" class="mb-0 header-favorite">
                        {{ Session::get('favorite') == null ? 0 : count(Session::get('favorite')) }}
                    </label>
                    <p class="mb-0">キープリスト</p>
                    {{--                    <p class="mb-0">Keep list</p>--}}
                </div>
                <div class="browsing-history position-relative">
                    <img src="{{asset('images/icon/icon_history.svg')}}" alt="icon-start">
                    <label for="" class="mb-0">
                        {{ Session::get('history') == null ? 0 : count(Session::get('history')) }}
                    </label>
                    <p class="mb-0">閲覧履歴</p>
                    {{--                    <p class="mb-0">Browsing history</p>--}}
                </div>
                <div class="open-menu">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
            </div>
            <div class="login">
                @if(\Illuminate\Support\Facades\Session::has('worker'))
                        <div class="login-success btn-login d-block">
                            <img src="{{asset('images/icon/log-in-success.png')}}" alt="login-img">
                            <a href="{{ route('worker.profile') }}">マイページ</a>
                        </div>
                    <div class="btn-login" style="margin-left: 20px">
                        <a href="{{ route('worker.logout') }}">ログアウト</a>
                    </div>
                @else
                    <div class="btn-sign-in">
                        <a href="{{ route('register.worker') }}">会員登録(無料)</a>
                    </div>
                    <div class="btn-login" data-bs-toggle="modal"
                         data-bs-target="#loginModal">
                        <img src="{{asset('images/icon/log-in.png')}}" alt="login-img">
                        <a>ログインする</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</header>
<div class="over_lay">

</div>
<div class="menu" id="menu-header">
    <i class="fas fa-times close-menu"></i>
    <div class="container">
        <ul>
            <li><a href="https://greff.co.jp/lp/worker/">はじめての方へ</a></li>
            <li><a href="https://corporate.greff.co.jp/">掲載ご希望の企業様</a></li>
            <li><a href="https://greff.co.jp/faq">よくある質問</a></li>
            <li><a href="https://greff.co.jp/lp/contact/">お問合せ</a></li>
        </ul>
    </div>
</div>

@include('client.modals.loginWorker')

@push('scripts')
    <script>
        $('.browsing-history ').on('click', function() {
            location.href = "{{ route('history') }}";
        });
        $('.keep-list').on('click', function() {
            location.href = "{{ route('favorite') }}";
        });
    </script>
@endpush

