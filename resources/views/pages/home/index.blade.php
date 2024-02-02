@extends("pages.globalPage")

@section("CSSLibraryExtraPage")
    {{--  Extra Library CSS  --}}
@endsection

@section("CSSExtraPage")
    {{--  Extra Manual CSS  --}}
@endsection

@section("ContentPage")
    <!-- start breadcrumb -->
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Home</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li>
                                <div class="drodown">
                                    <a href="#" class="dropdown-toggle btn btn-white btn-dim btn-outline-light" data-bs-toggle="dropdown" aria-expanded="false"><em class="d-none d-sm-inline icon ni ni-calender-date"></em><span><span class="d-none d-md-inline">Last</span> 30 Days</span><em class="dd-indc icon ni ni-chevron-right"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a href="#"><span>Last 30 Days</span></a></li>
                                            <li><a href="#"><span>Last 6 Months</span></a></li>
                                            <li><a href="#"><span>Last 1 Years</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="nk-block-tools-opt"><a href="#" class="btn btn-primary"><em class="icon ni ni-reports"></em><span>Reports</span></a></li>
                        </ul>
                    </div>
                </div>
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div>
    <!-- end breadcrumb -->
    <div class="nk-block">
        <div class="row g-gs">
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg3">
                        <div class="card-inner pb-0">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Total Sales</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount fw-normal">$9,495.20</div>
                                    <div class="info text-end">
                                        <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last month</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                        <div class="nk-ecwg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas class="courseSells chartjs-render-monitor" id="totalSells" width="461" height="66" style="display: block; width: 461px; height: 66px;"></canvas>
                        </div>
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg3">
                        <div class="card-inner pb-0">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">This week so far</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount fw-normal">$2,995.81</div>
                                    <div class="info text-end"><span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>7.13%</span><br><span>vs. last week</span></div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                        <div class="nk-ecwg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas class="courseSells chartjs-render-monitor" id="weeklySells" width="461" height="66" style="display: block; width: 461px; height: 66px;"></canvas>
                        </div>
                    </div><!-- .nk-ecwg -->
                </div>
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg3">
                        <div class="card-inner pb-0">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Total Sales</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount fw-normal">$9,495.20</div>
                                    <div class="info text-end">
                                        <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last month</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                        <div class="nk-ecwg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas class="courseSells chartjs-render-monitor" id="totalSells_2" width="461" height="66" style="display: block; width: 461px; height: 66px;"></canvas>
                        </div>
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div>
            <div class="col-xxl-3 col-sm-6">
                <div class="card">
                    <div class="nk-ecwg nk-ecwg3">
                        <div class="card-inner pb-0">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h6 class="title">Total Sales</h6>
                                </div>
                            </div>
                            <div class="data">
                                <div class="data-group">
                                    <div class="amount fw-normal">$9,495.20</div>
                                    <div class="info text-end">
                                        <span class="change up text-danger"><em class="icon ni ni-arrow-long-up"></em>4.63%</span><br><span>vs. last month</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- .card-inner -->
                        <div class="nk-ecwg3-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas class="courseSells chartjs-render-monitor" id="totalSells_3" width="461" height="66" style="display: block; width: 461px; height: 66px;"></canvas>
                        </div>
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div>
            <div class="col-md-6">
                <div class="card card-full overflow-hidden">
                    <div class="nk-ecwg nk-ecwg7 h-100">
                        <div class="card-inner flex-grow-1">
                            <div class="card-title-group mb-4">
                                <div class="card-title">
                                    <h6 class="title">Order Statistics</h6>
                                </div>
                            </div>
                            <div class="nk-ecwg7-ck"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas class="ecommerce-doughnut-s1 chartjs-render-monitor" id="orderStatistics" width="180" height="180" style="display: block; width: 180px; height: 180px;"></canvas>
                            </div>
                            <ul class="nk-ecwg7-legends">
                                <li>
                                    <div class="title">
                                        <span class="dot dot-lg sq" data-bg="#816bff" style="background: rgb(129, 107, 255);"></span>
                                        <span>Completed</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <span class="dot dot-lg sq" data-bg="#13c9f2" style="background: rgb(19, 201, 242);"></span>
                                        <span>Processing</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="title">
                                        <span class="dot dot-lg sq" data-bg="#ff82b7" style="background: rgb(255, 130, 183);"></span>
                                        <span>Cancelled</span>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- .card-inner -->
                    </div>
                </div><!-- .card -->
            </div>
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-inner">
                        <div class="card-title-group mb-2">
                            <div class="card-title">
                                <h6 class="title">Store Statistics</h6>
                            </div>
                        </div>
                        <ul class="nk-store-statistics">
                            <li class="item">
                                <div class="info">
                                    <div class="title">Orders</div>
                                    <div class="count">1,795</div>
                                </div>
                                <em class="icon bg-primary-dim ni ni-bag"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Customers</div>
                                    <div class="count">2,327</div>
                                </div>
                                <em class="icon bg-info-dim ni ni-users"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Products</div>
                                    <div class="count">674</div>
                                </div>
                                <em class="icon bg-pink-dim ni ni-box"></em>
                            </li>
                            <li class="item">
                                <div class="info">
                                    <div class="title">Categories</div>
                                    <div class="count">68</div>
                                </div>
                                <em class="icon bg-purple-dim ni ni-server"></em>
                            </li>
                        </ul>
                    </div><!-- .card-inner -->
                </div><!-- .card -->
            </div>
            <div class="col-12">
                <div class="card card-full">
                    <div class="card-inner">
                        <div class="card-title-group">
                            <div class="card-title">
                                <h6 class="title">Recent Orders</h6>
                            </div>
                        </div>
                    </div>
                    <div class="nk-tb-list mt-n2">
                        <div class="nk-tb-item nk-tb-head">
                            <div class="nk-tb-col"><span>Order No.</span></div>
                            <div class="nk-tb-col tb-col-sm"><span>Customer</span></div>
                            <div class="nk-tb-col tb-col-md"><span>Date</span></div>
                            <div class="nk-tb-col"><span>Amount</span></div>
                            <div class="nk-tb-col"><span class="d-none d-sm-inline">Status</span></div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead"><a href="#">#95954</a></span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-purple-dim">
                                        <span>AB</span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">Abu Bin Ishtiyak</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">02/11/2020</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-sub tb-amount">4,596.75 <span>USD</span></span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-success">Paid</span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead"><a href="#">#95850</a></span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-azure-dim">
                                        <span>DE</span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">Desiree Edwards</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">02/02/2020</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-sub tb-amount">596.75 <span>USD</span></span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-danger">Cancelled</span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead"><a href="#">#95812</a></span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <div class="user-card">
                                    <div class="chat-media user-avatar bg-pink">
                                        <span>BS</span>
                                        <span class="status dot dot-lg dot-success"></span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">Blanca Schultz</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">02/01/2020</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-sub tb-amount">199.99 <span>USD</span></span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-success">Paid</span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead"><a href="#">#95256</a></span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-purple-dim">
                                        <span>NL</span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">Naomi Lawrence</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">01/29/2020</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-sub tb-amount">1099.99 <span>USD</span></span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-success">Paid</span>
                            </div>
                        </div>
                        <div class="nk-tb-item">
                            <div class="nk-tb-col">
                                <span class="tb-lead"><a href="#">#95135</a></span>
                            </div>
                            <div class="nk-tb-col tb-col-sm">
                                <div class="user-card">
                                    <div class="user-avatar sm bg-success-dim">
                                        <span>CH</span>
                                    </div>
                                    <div class="user-name">
                                        <span class="tb-lead">Cassandra Hogan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="nk-tb-col tb-col-md">
                                <span class="tb-sub">01/29/2020</span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="tb-sub tb-amount">1099.99 <span>USD</span></span>
                            </div>
                            <div class="nk-tb-col">
                                <span class="badge badge-dot badge-dot-xs bg-warning">Due</span>
                            </div>
                        </div>
                    </div>
                </div><!-- .card -->
            </div>
        </div>
    </div>
@endsection

@section("ModalPopup")
    {{--  Modal Popups  --}}
@endsection

@section("extraScriptsPage")
{{--    <script src="{{ asset("System/assets/js/charts/chart-lms.js") }}"--}}
{{--            type="text/javascript"></script>--}}
{{--    <script src="{{ asset("System/assets/js/charts/chart-ecommerce.js") }}"--}}
{{--            type="text/javascript"></script>--}}
@endsection
