<div class="header-left">
    <div class="dropdown category-dropdown">
        <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="دسته بندی فروشگاه">
            فهرست دسته بندی ها <i class="icon-angle-down"></i>
        </a>

        <div class="dropdown-menu">
            <nav class="side-nav">
                <ul class="menu-vertical sf-arrows sf-js-enabled" style="touch-action: pan-y;">
                    @foreach ($categories as $item)
                    <li class="item-lead"><a href="#">{{ $item->name }}</a></li>
                    {{-- <li><a href="#">تخت خواب</a></li> --}}
                    @endforeach
                </ul><!-- End .menu-vertical -->
            </nav><!-- End .side-nav -->
        </div><!-- End .dropdown-menu -->
    </div><!-- End .category-dropdown -->
</div><!-- End .header-left -->
