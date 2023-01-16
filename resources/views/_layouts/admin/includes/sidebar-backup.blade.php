<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ route('admin.home.index') }}"><i class="side-menu-icon fa fa-laptop"></i>پیشخوان </a>
                </li>
                {{-- @isset($_center)
                    <li class="">
                        <a href="{{ route('admin.center.inner.index', $_center->id) }}"><i class="side-menu-icon {{ $_center->fontIcon() }}"></i>{{ $_center->full_name }} </a>
                    </li>
                @endisset --}}


                @foreach ($_public_menus as $menu)
                    @if(isset($menu['sub']) && $menu['sub'])
                        <li class="menu-item-has-children dropdown" id="menu-{{ $menu['name'] }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                            @isset($menu['sub'])
                                <ul class="sub-menu children dropdown-menu">
                                    @foreach ($menu['sub'] as $sub)
                                        <li><a href="{{ $sub['link'] }}"><i class="{{ $sub['icon'] ?? 'fas fa-minus' }}"></i> {{ $sub['title'] }}</a></li>
                                    @endforeach
                                </ul>
                            @endisset
                        </li>
                    @else
                        <li>
                            <a href="{{ $menu['link'] }}" class="{{ $menu['class'] ?? '' }}"><i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                        </li>
                    @endif
                @endforeach

                @foreach ($_bottom_public_menus as $menu)
                    @if(isset($menu['sub']) && $menu['sub'])
                        <li class="menu-item-has-children dropdown" id="menu-{{ $menu['name'] }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                            @isset($menu['sub'])
                                <ul class="sub-menu children dropdown-menu">
                                    @foreach ($menu['sub'] as $sub)
                                        <li><a href="{{ $sub['link'] }}"><i class="{{ $sub['icon'] ?? 'fas fa-minus' }}"></i> {{ $sub['title'] }}</a></li>
                                    @endforeach
                                </ul>
                            @endisset
                        </li>
                    @else
                        <li>
                            <a href="{{ $menu['link'] }}" class="{{ $menu['class'] ?? '' }}"><i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- @foreach ($_public_menus as $menu)
                    @if($_user->hasap($_center, $menu['permission']))
                        @if(isset($menu['sub']) && $menu['sub'])
                            <li class="menu-item-has-children dropdown" id="menu-{{ $menu['name'] }}">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                                @isset($menu['sub'])
                                    <ul class="sub-menu children dropdown-menu">
                                        @foreach ($menu['sub'] as $sub)
                                            @if($_user->isSuperAdmin() || $_user->hasap($_center, $sub['permission']))
                                                <li><a href="{{ $sub['link'] }}"><i class="{{ $sub['icon'] ?? 'fas fa-minus' }}"></i> {{ $sub['title'] }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endisset
                            </li>
                        @else
                            <li>
                                <a href="{{ $menu['link'] }}" class="{{ $menu['class'] ?? '' }}"><i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                            </li>
                        @endif
                    @endif
                @endforeach



                @if(count($_executable_menus))
                    <li class="menu-title text-danger">کاربر اجرایی</li>

                    @foreach ($_executable_menus as $menu)
                        @if(isset($menu['center_dependent']))
                            @if($_user->isSuperAdmin() || $_user->hasap($_center, $menu['permission']))
                                @if(isset($menu['sub']) && $menu['sub'])
                                    <li class="menu-item-has-children dropdown" id="menu-{{ $menu['name'] }}">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                                        @isset($menu['sub'])
                                            <ul class="sub-menu children dropdown-menu">
                                                @foreach ($menu['sub'] as $sub)
                                                    @if($_user->isSuperAdmin() || $_user->hasap($_center, $sub['permission']))
                                                        <li><a href="{{ $sub['link'] }}"><i class="{{ $sub['icon'] ?? 'fas fa-minus' }}"></i> {{ $sub['title'] }}</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endisset
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $menu['link'] }}" class="{{ $menu['class'] ?? '' }}"><i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                                    </li>
                                @endif
                            @endif
                        @else
                            @if($_user->isSuperAdmin() || $_user->hasAnyPermission($menu['permission']))
                                @if(isset($menu['sub']) && $menu['sub'])
                                    <li class="menu-item-has-children dropdown" id="menu-{{ $menu['name'] }}">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                                        @isset($menu['sub'])
                                            <ul class="sub-menu children dropdown-menu">
                                                @foreach ($menu['sub'] as $sub)
                                                    @if($_user->isSuperAdmin() || $_user->hasAnyPermission($sub['permission']))
                                                        <li><a href="{{ $sub['link'] }}"><i class="{{ $sub['icon'] ?? 'fas fa-minus' }}"></i> {{ $sub['title'] }}</a></li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        @endisset
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $menu['link'] }}" class="{{ $menu['class'] ?? '' }}"><i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                                    </li>
                                @endif

                            @endif
                        @endif
                    @endforeach
                @endif


                @if(count($_personal_menus))
                    <li class="menu-title text-danger">کاربر شخصی</li>

                    @foreach ($_personal_menus as $menu)
                        @if($_user->isSuperAdmin() || $_user->hasAnyPermission($menu['permission']))
                            @if(isset($menu['sub']) && $menu['sub'])
                                <li class="menu-item-has-children dropdown" id="menu-{{ $menu['name'] }}">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                                    @isset($menu['sub'])
                                        <ul class="sub-menu children dropdown-menu">
                                            @foreach ($menu['sub'] as $sub)
                                                @if($_user->isSuperAdmin() || $_user->hasAnyPermission($sub['permission']))
                                                    <li><a href="{{ $sub['link'] }}"><i class="{{ $sub['icon'] ?? 'fas fa-minus' }}"></i> {{ $sub['title'] }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endisset
                                </li>
                            @else
                                <li>
                                    <a href="{{ $menu['link'] }}" class="{{ $menu['class'] ?? '' }}"><i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                                </li>
                            @endif

                        @endif
                    @endforeach
                @endif


                @foreach ($_bottom_public_menus as $menu)
                    @if($_user->hasap($_center, $menu['permission']))
                        @if(isset($menu['sub']) && $menu['sub'])
                            <li class="menu-item-has-children dropdown" id="menu-{{ $menu['name'] }}">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                                @isset($menu['sub'])
                                    <ul class="sub-menu children dropdown-menu">
                                        @foreach ($menu['sub'] as $sub)
                                            @if($_user->isSuperAdmin() || $_user->hasap($_center, $sub['permission']))
                                                <li><a href="{{ $sub['link'] }}"><i class="{{ $sub['icon'] ?? 'fas fa-minus' }}"></i> {{ $sub['title'] }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endisset
                            </li>
                        @else
                            <li>
                                <a href="{{ $menu['link'] }}" class="{{ $menu['class'] ?? '' }}"><i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                            </li>
                        @endif
                    @endif
                @endforeach --}}
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</aside>
