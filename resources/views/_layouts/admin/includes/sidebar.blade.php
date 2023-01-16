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




                @foreach ($_main_menus as $menu)
                    @if($_current_user->can($menu['permission']))
                        @if(isset($menu['sub']) && $menu['sub'])
                            <li class="menu-item-has-children dropdown" id="menu-{{ $menu['name'] }}">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                                @isset($menu['sub'])
                                    <ul class="sub-menu children dropdown-menu">
                                        @foreach ($menu['sub'] as $sub)
                                            @if($_current_user->can($sub['permission']))
                                                <li><a href="{{ $sub['link'] }}"><i class="{{ $sub['icon'] ?? 'fas fa-minus' }}"></i> {{ $sub['title'] }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endisset
                            </li>
                        @else
                            <li>
                                <a href="{{ $menu['link'] }}" class="{{ $menu['class'] ?? '' }}"><i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}{!! isset($menu['counter']) ? " <span class='text-danger number-fa'>({$menu['counter']})</span>" : '' !!}</a>
                            </li>
                        @endif
                    @endif
                @endforeach

                @foreach ($_center_menus as $menu)
                    @if($_current_user->isSuperAdmin() || $_current_user->hasap($_center, $menu['permission']))
                        <li class="menu-item-has-children dropdown show" id="menu-{{ $menu['name'] }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                            @isset($menu['sub'])
                                <ul class="sub-menu children dropdown-menu show">
                                    @foreach ($menu['sub'] as $sub)
                                        @if($_current_user->isSuperAdmin() || $_current_user->hasap($_center, $sub['permission']))
                                            <li><a href="{{ $sub['link'] }}"><i class="{{ $sub['icon'] ?? 'fas fa-minus' }}"></i> {{ $sub['title'] }}</a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endisset
                        </li>
                    @endif
                @endforeach


                @foreach ($_bottom_menus as $menu)
                    @if($_current_user->can($menu['permission']))
                        @if(isset($menu['sub']) && $menu['sub'])
                            <li class="menu-item-has-children dropdown" id="menu-{{ $menu['name'] }}">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}</a>
                                @isset($menu['sub'])
                                    <ul class="sub-menu children dropdown-menu">
                                        @foreach ($menu['sub'] as $sub)
                                            @if($_current_user->can($sub['permission']))
                                                <li><a href="{{ $sub['link'] }}"><i class="{{ $sub['icon'] ?? 'fas fa-minus' }}"></i> {{ $sub['title'] }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endisset
                            </li>
                        @else
                            <li>
                                <a href="{{ $menu['link'] }}" class="{{ $menu['class'] ?? '' }}"><i class="side-menu-icon {{ $menu['icon'] }}"></i>{{ $menu['title'] }}{!! isset($menu['counter']) ? " <span class='text-danger number-fa'>({$menu['counter']})</span>" : '' !!}</a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</aside>
