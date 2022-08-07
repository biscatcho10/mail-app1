@extends("admin.layouts.index")
@section("title", title('Dashboard'))
@section("content")
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="nav-icon fas fa-at"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Email accounts</span>
                            <span class="info-box-number">{{number_format($emails)}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="nav-icon fas fa-box"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Categories</span>
                            <span class="info-box-number">{{number_format($categories)}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-warning">
                        <span class="info-box-icon"><i class="nav-icon fas fa-mail-bulk"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Sent emails</span>
                            <span class="info-box-number">{{number_format($mails)}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="info-box bg-danger">
                        <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Scheduled Mails</span>
                            <span class="info-box-number">{{number_format($scheduled_mails)}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-7 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Visitors Browsers</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <input type="hidden" id="browserusage" data-target="{{route("browserUsage")}}">
                            <canvas id="pieChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 764px;"
                                    width="764" height="250" class="chartjs-render-monitor"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">
                    <!-- Map card -->
                    <div class="card bg-gradient-primary">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Visitors
                            </h3>
                            <!-- card tools -->
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                                    <i class="far fa-calendar-alt"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse"
                                        title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <div class="card-body">
                            <input type="hidden" id="urltovisitors" data-target="{{route("mapData")}}">
                            <div id="world-map" style="height: 250px; width: 100%;"></div>
                            <style>
                                .jqvmap-zoomin, .jqvmap-zoomout {
                                    padding: 0;
                                    padding-top: 1px;
                                    padding-right: 1px;
                                }
                            </style>
                        </div>
                    </div>
                    <!-- /.card -->
                    <div class="card bg-gradient-success">
                        <div class="card-header border-0">

                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                            </h3>
                            <!-- tools card -->
                            <div class="card-tools">
                                <!-- button with a dropdown -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle"
                                            data-toggle="dropdown" data-offset="-52">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="#" class="dropdown-item">Add new event</a>
                                        <a href="#" class="dropdown-item">Clear events</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">View calendar</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
@endsection
