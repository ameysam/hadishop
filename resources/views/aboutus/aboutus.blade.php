@extends('_layouts.front.index')

@section('content')
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">درباره {{ config('app.name') }}<span></span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.home.index') }}">خانه</a></li>
                <li class="breadcrumb-item active" aria-current="page">درباره {{ config('app.name') }}</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content pb-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="about-text text-center mt-3">
                        <h2 class="title text-center mb-2">ما که هستیم</h2><!-- End .title text-center mb-2 -->
                        <p class="text-center">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم، لورم ایپسوم متن
                            ساختگی با تولید سادگی
                            نامفهوملورم ایپسوم متن ساختگی با تولید سادگی نامفهوم، لورم ایپسوم متن ساختگی با
                            تولید
                            سادگی نامفهوم. لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی
                            با تولید سادگی نامفهوم لورم ایپسوم متن ساختگی با
                            تولید سادگی نامفهوم! لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم. </p>
                        <img src="{{ asset('assets/front/images/signature.png') }}" alt="signature"
                            class="mx-auto mb-5">

                        <img src="{{ asset('assets/front/images/img-1.jpg') }}" alt="image" class="mx-auto mb-6">
                    </div><!-- End .about-text -->
                </div><!-- End .col-lg-10 offset-1 -->
            </div><!-- End .row -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-sm text-center">
                        <span class="icon-box-icon">
                            <i class="icon-puzzle-piece"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">طراحی فوق العاده</h3><!-- End .icon-box-title -->

                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->

                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-sm text-center">
                        <span class="icon-box-icon">
                            <i class="icon-life-ring"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">پشتیباین حرفه ای</h3><!-- End .icon-box-title -->

                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->

                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-sm text-center">
                        <span class="icon-box-icon">
                            <i class="icon-heart-o"></i>
                        </span>
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">تولید با علاقه</h3><!-- End .icon-box-title -->

                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->
            </div><!-- End .row -->
        </div><!-- End .container -->


    </div><!-- End .page-content -->
@endsection
