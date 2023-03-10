@extends('_layouts.admin.index')

@section('content')
    <!-- Widgets  -->
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-1">
                            <i class="pe-7s-cash"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">2356</span> تومان</div>
                                <div class="stat-heading">شارژ حساب</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-2">
                            <i class="pe-7s-cart"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">3435</span></div>
                                <div class="stat-heading">فروش</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-3">
                            <i class="pe-7s-browser"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">349</span></div>
                                <div class="stat-heading">قالب</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-five">
                        <div class="stat-icon dib flat-color-4">
                            <i class="pe-7s-users"></i>
                        </div>
                        <div class="stat-content">
                            <div class="text-left dib">
                                <div class="stat-text"><span class="count">2986</span></div>
                                <div class="stat-heading">مشتری</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Widgets -->
    <!--  Traffic  -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="box-title">ترافیک </h4>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card-body">
                            <!-- <canvas id="TrafficChart"></canvas>   -->
                            <div id="traffic-chart" class="traffic-chart"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card-body">
                            <div class="progress-box progress-1">
                                <h4 class="por-title">Visits</h4>
                                <div class="por-txt">96,930 Users (40%)</div>
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-flat-color-1" role="progressbar" style="width: 40%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="progress-box progress-2">
                                <h4 class="por-title">Bounce Rate</h4>
                                <div class="por-txt">3,220 Users (24%)</div>
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-flat-color-2" role="progressbar" style="width: 24%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="progress-box progress-2">
                                <h4 class="por-title">Unique Visitors</h4>
                                <div class="por-txt">29,658 Users (60%)</div>
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-flat-color-3" role="progressbar" style="width: 60%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="progress-box progress-2">
                                <h4 class="por-title">Targeted Visitors</h4>
                                <div class="por-txt">99,658 Users (90%)</div>
                                <div class="progress mb-2" style="height: 5px;">
                                    <div class="progress-bar bg-flat-color-4" role="progressbar" style="width: 90%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <!-- /.row -->
                <div class="card-body"></div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <!--  /Traffic -->
    <div class="clearfix"></div>
    <!-- Orders -->
    <div class="orders">
        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Orders </h4>
                    </div>
                    <div class="card-body--">
                        {{-- <div class="table table-responsive table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th class="avatar">Avatar</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="serial">1.</td>
                                        <td class="avatar">
                                            <div class="round-img">
                                                <a href="#"><img class="rounded-circle" src="images/avatar/1.jpg" alt=""></a>
                                            </div>
                                        </td>
                                        <td> #5469 </td>
                                        <td> <span class="name">Louis Stanley</span> </td>
                                        <td> <span class="product">iMax</span> </td>
                                        <td><span class="count">231</span></td>
                                        <td>
                                            <span class="badge badge-complete">Complete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="serial">2.</td>
                                        <td class="avatar">
                                            <div class="round-img">
                                                <a href="#"><img class="rounded-circle" src="images/avatar/2.jpg" alt=""></a>
                                            </div>
                                        </td>
                                        <td> #5468 </td>
                                        <td> <span class="name">Gregory Dixon</span> </td>
                                        <td> <span class="product">iPad</span> </td>
                                        <td><span class="count">250</span></td>
                                        <td>
                                            <span class="badge badge-complete">Complete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="serial">3.</td>
                                        <td class="avatar">
                                            <div class="round-img">
                                                <a href="#"><img class="rounded-circle" src="images/avatar/3.jpg" alt=""></a>
                                            </div>
                                        </td>
                                        <td> #5467 </td>
                                        <td> <span class="name">Catherine Dixon</span> </td>
                                        <td> <span class="product">SSD</span> </td>
                                        <td><span class="count">250</span></td>
                                        <td>
                                            <span class="badge badge-complete">Complete</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="serial">4.</td>
                                        <td class="avatar">
                                            <div class="round-img">
                                                <a href="#"><img class="rounded-circle" src="images/avatar/4.jpg" alt=""></a>
                                            </div>
                                        </td>
                                        <td> #5466 </td>
                                        <td> <span class="name">Mary Silva</span> </td>
                                        <td> <span class="product">Magic Mouse</span> </td>
                                        <td><span class="count">250</span></td>
                                        <td>
                                            <span class="badge badge-pending">Pending</span>
                                        </td>
                                    </tr>
                                    <tr class=" pb-0">
                                        <td class="serial">5.</td>
                                        <td class="avatar pb-0">
                                            <div class="round-img">
                                                <a href="#"><img class="rounded-circle" src="images/avatar/6.jpg" alt=""></a>
                                            </div>
                                        </td>
                                        <td> #5465 </td>
                                        <td> <span class="name">Johnny Stephens</span> </td>
                                        <td> <span class="product">Monitor</span> </td>
                                        <td><span class="count">250</span></td>
                                        <td>
                                            <span class="badge badge-complete">Complete</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> --}}
                        <!-- /.table-stats -->
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-lg-8 -->

            <div class="col-xl-4">
                <div class="row">
                    <div class="col-lg-6 col-xl-12">
                        <div class="card br-0">
                            <div class="card-body">
                                <div class="chart-container ov-h">
                                    <div id="flotPie1" class="float-chart"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-lg-6 col-xl-12">
                        <div class="card bg-flat-color-3  ">
                            <div class="card-body">
                                <h4 class="card-title m-0  white-color ">August 2018</h4>
                            </div>
                            <div class="card-body">
                                <div id="flotLine5" class="flot-line"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-md-4 -->
        </div>
    </div>
    <!-- /.orders -->

    <!-- Calender Chart Weather  -->
    <div class="row">
        <div class="col-md-12 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="box-title">Chandler</h4> -->
                    <div class="calender-cont widget-calender">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="card ov-h">
                <div class="card-body bg-flat-color-2">
                    <div id="flotBarChart" class="float-chart ml-4 mr-4"></div>
                </div>
                <div id="cellPaiChart" class="float-chart"></div>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card weather-box">
                <h4 class="weather-title box-title">Weather</h4>
                <div class="card-body">
                    <div class="weather-widget">
                        <div id="weather-one" class="weather-one"></div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /Calender Chart Weather -->

    {{-- <div class="row">
        <div class="col-xs-12 pd5">
            @foreach($places as $place)
                <a href="{{ route('admin.place.show', $place->id) }}" class="btn btn-primary"><i class="fa fa-plus"></i>&nbsp;{{ $place->name }} </a>
            @endforeach
        </div>
    </div> --}}
@endsection
