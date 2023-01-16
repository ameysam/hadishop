<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-12">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('admin.home.index') }}">پیشخوان</a></li>
                            @if(!empty($_page_breadcrumb))
                                @foreach($_page_breadcrumb as $item)
                                    <li @if($loop->last) class="active" @endif>
                                        <a href="{{$item['link']}}">{{$item['title']}}</a>
                                    </li>
                                @endforeach
                            @endif

                            {{-- <li><a href="#">پیشخوان</a></li>
                            <li><a href="#">صفحه اول</a></li>
                            <li class="active">صفحه دوم</li> --}}
                        </ol>
                    </div>
                </div>
            </div>

            {{-- <div class="col-sm-8">
                <div class="float-left">
                    <div class="page-button">
                        <button class="btn btn-primary btn-sm">انتشار</button>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
