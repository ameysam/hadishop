<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('front.home.index') }}" target="_blank"><img
                src="/logo.png" alt="{{ config('app.name') }}" width="100px"></a>
            <a class="navbar-brand hidden" href="{{ route('front.home.index') }}" target="_blank"><img
                    src="/logo.png" alt="{{ config('app.name') }}"></a>
            {{-- <img src="{{ asset('assets/images/imed-logo.png') }}" width="75px" alt="" class="img-fluid"> --}}

            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
        </div>
    </div>

    <div class="top-right">
        <div class="header-menu">
            <div class="header-left">
                {{-- <div class="dropdown for-notification">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-bell"></i>
                        <span class="count bg-danger">3</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="notification">
                        <p class="red">شما 3 اطلاعیه جدید دارید</p>
                        <a class="dropdown-item media" href="#">
                            <i class="fa fa-check"></i>
                            <p>سرور شماره 1 در دسترس است</p>
                        </a>
                        <a class="dropdown-item media" href="#">
                            <i class="fa fa-info"></i>
                            <p>سرور شماره 2 در دسترس قرار گرفت</p>
                        </a>
                        <a class="dropdown-item media" href="#">
                            <i class="fa fa-warning"></i>
                            <p>سرور شماره 3 در دسترس نیست</p>
                        </a>
                    </div>
                </div> --}}

                {{-- <div class="dropdown for-message">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="message" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-envelope"></i>
                        <span class="count bg-primary">4</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="message">
                        <p class="red">شما 4 پیام جدید دارید</p>
                        <a class="dropdown-item media" href="#">
                            <span class="photo media-left"><img alt="avatar" src="images/avatar/1.jpg"></span>
                            <div class="message media-body">
                                <span class="name float-left">Jonathan Smith</span>
                                <span class="time float-right">Just now</span>
                                <p>Hello, this is an example msg</p>
                            </div>
                        </a>
                        <a class="dropdown-item media" href="#">
                            <span class="photo media-left"><img alt="avatar" src="images/avatar/2.jpg"></span>
                            <div class="message media-body">
                                <span class="name float-left">Jack Sanders</span>
                                <span class="time float-right">5 minutes ago</span>
                                <p>Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                        </a>
                        <a class="dropdown-item media" href="#">
                            <span class="photo media-left"><img alt="avatar" src="images/avatar/3.jpg"></span>
                            <div class="message media-body">
                                <span class="name float-left">Cheryl Wheeler</span>
                                <span class="time float-right">10 minutes ago</span>
                                <p>Hello, this is an example msg</p>
                            </div>
                        </a>
                        <a class="dropdown-item media" href="#">
                            <span class="photo media-left"><img alt="avatar" src="images/avatar/4.jpg"></span>
                            <div class="message media-body">
                                <span class="name float-left">Rachel Santos</span>
                                <span class="time float-right">15 minutes ago</span>
                                <p>Lorem ipsum dolor sit amet, consectetur</p>
                            </div>
                        </a>
                    </div>
                </div> --}}

                {{-- <div class="dropdown for-message">
                    <a href="{{ route('admin.message.index') }}" class="btn btn-secondary dropdown-toggle text-muted" id="btn-message-global">
                        <i class="fa fa-bell"></i>
                        @if($_unseen_messages_count > 0)
                            <span class="count bg-danger unseen_message_count">{{ $_unseen_messages_count ?? '' }}</span>
                        @else
                            <span class="count bg-danger unseen_message_count d-none"></span>
                        @endif
                    </a>
                </div> --}}
            </div>
            <div class="user-area dropdown float-right">
                <span>{{ $_current_user->full_name }}</span>
            </div>
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img class="user-avatar rounded-circle" src="/avatar.png" alt="User Avatar">
                </a>

                <div class="user-menu dropdown-menu">
                    {{-- <a class="nav-link" href="#"><i class="fa fa- user"></i>حساب کاربری من</a> --}}

                    {{-- <a class="nav-link" href="#"><i class="fa fa- user"></i>اطلاعیه ها <span class="count">13</span></a> --}}


                    {{-- @if($_current_user->can('personnel-doctor') || $_current_user->can('perscription-add'))
                        <a class="nav-link" href="{{ route('admin.profile.doctor.edit') }}"><i
                                class="fas fa-user-md"></i>پروفایل پزشکی</a>
                    @endif

                    <a class="nav-link" href="{{ route('admin.profile.wallet.index') }}"><i
                            class="fas fa-wallet"></i>کیف پول</a>

                    <a class="nav-link" href="{{ route('admin.profile.info.edit') }}"><i
                            class="fas fa-user-cog"></i>ویرایش حساب کاربری</a>

                    <a class="nav-link" href="{{ route('admin.profile.password.edit') }}"><i
                            class="fas fa-user-lock"></i>بازنشانی رمز عبور</a>

                    <a class="nav-link" href="{{ route('admin.profile.role.index') }}"><i
                            class="fas fa-handshake"></i>نقش‌های من</a> --}}
                    <a class="nav-link" href="{{ route('admin.profile.edit') }}"><i
                                class="fas fa-user-cog"></i>ویرایش پروفایل</a>
                    <a class="nav-link" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i>خروج</a>
                </div>
            </div>

        </div>
    </div>
</header>
