
<nav class="mobile-cats-nav">
    <ul class="mobile-cats-menu">
        @foreach ($categories as $item)
            <li><a class="mobile-cats-lead" href="{{ $item->urlShow() }}">{{ $item->name }}</a></li>
        {{-- <li><a href="#">تخت خواب</a></li> --}}
        @endforeach
    </ul><!-- End .mobile-cats-menu -->
</nav><!-- End .mobile-cats-nav -->
