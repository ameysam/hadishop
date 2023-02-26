@extends('_layouts.front.index')

@section('content')

    <div class="page-header text-center" style="background-image: url('{{ asset("assets/front/images/page-header-bg.jpg") }}')">
        <div class="container">
            <h1 class="page-title">فروشگاه<span></span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">خانه</a></li>
                <li class="breadcrumb-item active"><a href="{{ route('front.product.index') }}">فروشگاه</a></li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        {{-- <div class="toolbox-left">
                            <div class="toolbox-info">
                                نمایش <span>9 از 56</span> محصول
                            </div><!-- End .toolbox-info -->
                        </div><!-- End .toolbox-left --> --}}

                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <label for="sortby">مرتب سازی براساس : </label>
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control">
                                        <option value="popularity" selected="selected">بیشترین خرید</option>
                                        <option value="rating">بیشترین امتیاز</option>
                                        <option value="date">تاریخ</option>
                                    </select>
                                </div>
                            </div><!-- End .toolbox-sort -->
                        </div><!-- End .toolbox-right -->
                    </div><!-- End .toolbox -->

                    <div class="products mb-3">
                        <div class="row justify-content-center">
                            @foreach ($records as $item)
                                <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                    @component('products._self.front.item')
                                        @slot('item', $item)
                                    @endcomponent
                                </div>
                            @endforeach

                        </div><!-- End .row -->
                    </div><!-- End .products -->

                    <div class="col-xs-12 text-center">
                        {{ $records->links() }}
                    </div>



                    {{-- <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1"
                                    aria-disabled="true">
                                    <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>قبلی
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item-total">از 6</li>
                            <li class="page-item">
                                <a class="page-link page-link-next" href="#" aria-label="Next">
                                    بعدی <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav> --}}
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                    <div class="sidebar sidebar-shop">
                        <div class="widget widget-clean">
                            <label>فیلترها : </label>
                            <a href="#" class="sidebar-filter-clear">پاک کردن همه</a>
                        </div><!-- End .widget widget-clean -->

                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                    aria-controls="widget-1">
                                    دسته بندی
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-1">
                                <div class="widget-body">
                                    <div class="filter-items filter-items-count">
                                        @foreach ($categories as $item)
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="cat-{{ $item->id }}">
                                                    <label class="custom-control-label" for="cat-{{ $item->id }}">{{ $item->name }}</label>
                                                </div><!-- End .custom-checkbox -->
                                                {{-- <span class="item-count">3</span> --}}
                                            </div><!-- End .filter-item -->
                                        @endforeach
                                    </div><!-- End .filter-items -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->


                        <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                    aria-controls="widget-5">
                                    قیمت
                                </a>
                            </h3><!-- End .widget-title -->

                            <div class="collapse show" id="widget-5">
                                <div class="widget-body">
                                    <div class="filter-price">
                                        <div class="filter-price-text">
                                            محدوده قیمت :
                                            <span id="filter-price-range"></span>
                                        </div><!-- End .filter-price-text -->

                                        <div id="price-slider"></div><!-- End #price-slider -->
                                    </div><!-- End .filter-price -->
                                </div><!-- End .widget-body -->
                            </div><!-- End .collapse -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar sidebar-shop -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
@endsection
