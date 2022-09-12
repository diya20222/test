@extends('admin.master')
@section('title', 'Admin | Dashboard')

@section('main')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-6 grid-margin stretch-card">
                <div class="row w-100 flex-grow">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Website Audience Metrics</p>
                                <p class="text-muted">25% more traffic than previous week</p>
                                <div class="row mb-3">
                                    <div class="col-md-7">
                                        <div class="d-flex justify-content-between traffic-status">
                                            <div class="item">
                                                <p class="mb-">Users</p>
                                                <h5 class="font-weight-bold mb-0">93,956</h5>
                                                <div class="color-border"></div>
                                            </div>
                                            <div class="item">
                                                <p class="mb-">Bounce Rate</p>
                                                <h5 class="font-weight-bold mb-0">58,605</h5>
                                                <div class="color-border"></div>
                                            </div>
                                            <div class="item">
                                                <p class="mb-">Page Views</p>
                                                <h5 class="font-weight-bold mb-0">78,254</h5>
                                                <div class="color-border"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <ul class="nav nav-pills nav-pills-custom justify-content-md-end" id="pills-tab-custom" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="pills-home-tab-custom" data-toggle="pill" href="#pills-health" role="tab" aria-controls="pills-home" aria-selected="true">
                                                    Day
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-profile-tab-custom" data-toggle="pill" href="#pills-career" role="tab" aria-controls="pills-profile" aria-selected="false">
                                                    Week
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="pills-contact-tab-custom" data-toggle="pill" href="#pills-music" role="tab" aria-controls="pills-contact" aria-selected="false">
                                                    Month
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <canvas id="audience-chart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6 grid-margin stretch-card">
                <div class="row w-100 flex-grow">
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Regional Load</p>
                                <p class="text-muted">Last update: 2 Hours ago</p>
                                <div class="regional-chart-legend d-flex align-items-center flex-wrap mb-1" id="regional-chart-legend"></div>
                                <canvas height="280" id="regional-chart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between flex-wrap">
                                    <p class="card-title">Today Task</p>
                                    <p class="text-success font-weight-medium">45.39 %</p>
                                </div>
                                <div class="d-flex align-items-center flex-wrap mb-3">
                                    <h5 class="font-weight-normal mb-0 mb-md-1 mb-lg-0 mr-3">17.247</h5>
                                    <p class="text-muted mb-0">Avg Sessions</p>
                                </div>
                                <canvas id="task-chart" height="200"></canvas>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- row end -->
        <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-facebook d-flex align-items-center">
                    <div class="card-body py-5">
                        <div class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                            <i class="fa fa-facebook" aria-hidden="true" style="font-size: 40px; color:white;"></i>
                            <div class="ml-3 ml-md-0 ml-xl-3">
                                <h5 class="text-white font-weight-bold">2.62 Subscribers</h5>
                                <p class="mt-2 text-white card-text">You main list growing</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-google d-flex align-items-center">
                    <div class="card-body py-5">
                        <div class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                            <i class="fa fa-google-plus" aria-hidden="true" style="font-size: 40px; color:white;"></i>
                            <div class="ml-3 ml-md-0 ml-xl-3">
                                <h5 class="text-white font-weight-bold">3.4k Followers</h5>
                                <p class="mt-2 text-white card-text">You main list growing</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
                <div class="card bg-twitter d-flex align-items-center">
                    <div class="card-body py-5">
                        <div class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                            <i class="fa fa-twitter" aria-hidden="true" style="font-size: 40px; color:white;"></i>
                            <div class="ml-3 ml-md-0 ml-xl-3">
                                <h5 class="text-white font-weight-bold">3k followers</h5>
                                <p class="mt-2 text-white card-text">You main list growing</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- row end -->
    </div>
    <script src="{{asset('admin/asset/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('admin/asset/js/Chart.min.js')}}"></script>
    <script src="{{asset('admin/asset/js/dashboard.js')}}"></script>
    @endsection