@extends('layouts.master')
@section('title', 'برنامج الفواتير')
@section('css')
    <!--  Owl-carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet" />
    <!-- Maps css -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="{{ URL::asset('assets/plugins/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="row row-cols-1  g-4 mt-2">
            <div class="col-3">
                <div class="card text-bg-dark h-100">
                    {{-- <img src="{{ URL::asset('img/statistic image.png') }}" class="card-img h-100" alt="..."> --}}
                    <div class="card-body">
                        <h5 class="card-title">اجمالى الفاتوره</h5>
                        {{ number_format(\App\Models\Invoice::sum('total'), 2) }}
                        <p class="card-text">عدد الفواتير : {{ \App\Models\Invoice::count() }}</p>
                        <div class="w3-light-grey w3-round">
                            <div class="w3-container w3-round w3-blue" style="width:100%">100</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-bg-dark h-100">
                    {{-- <img src="{{ URL::asset('img/statistic image1.png') }}" class="card-img h-100" alt="..."> --}}
                    <div class="card-img-overlay">
                        <h5 class="card-title"> اجمالى الفاتوره المدفوعه</h5>
                        {{ number_format(\App\Models\Invoice::where('valueStatus', '=', 1)->sum('total'), 2) }}
                        <p class="card-text">عدد الفواتير : {{ \App\Models\Invoice::where('valueStatus', 1)->count() }}</p>
                        <div class="w3-light-grey w3-round">
                            <div class="w3-container w3-round w3-green"
                                style="width:{{ round((\App\Models\Invoice::where('valueStatus', '=', 1)->count() / \App\Models\Invoice::count()) * 100) }}%">
                                {{ round((\App\Models\Invoice::where('valueStatus', '=', 1)->count() / \App\Models\Invoice::count()) * 100) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-bg-dark h-100">
                    {{-- <img src="{{ URL::asset('img/statistic image2.png') }}" class="card-img h-100" alt="..."> --}}
                    <div class="card-img-overlay">
                        <h5 class="card-title">اجمالى الفاتوره غير مدفوعه</h5>
                        {{ number_format(\App\Models\Invoice::where('valueStatus', '=', 2)->sum('total'), 2) }}
                        <p class="card-text">عدد الفواتير :
                            {{ \App\Models\Invoice::where('valueStatus', '=', 2)->count() }}
                        </p>
                        <div class="w3-light-grey w3-round">
                            <div class="w3-container w3-round w3-red"
                                style="width:{{ round((\App\Models\Invoice::where('valueStatus', '=', 2)->count() / \App\Models\Invoice::count()) * 100) }}%">
                                {{ round((\App\Models\Invoice::where('valueStatus', '=', 2)->count() / \App\Models\Invoice::count()) * 100) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card text-bg-dark h-100">
                    {{-- <img src="{{ URL::asset('img/statistic image3.png') }}" class="card-img h-100" alt="..."> --}}
                    <div class="card-img-overlay">
                        <h5 class="card-title">اجمالى الفاتوره المدفوعه جزئيا</h5>
                        {{ number_format(\App\Models\Invoice::where('valueStatus', '=', 3)->sum('total'), 2) }}
                        <p class="card-text">عدد الفواتير :
                            {{ \App\Models\Invoice::where('valueStatus', '=', 3)->count() }}
                        </p>
                        <div class="w3-light-grey w3-round">
                            <div class="w3-container w3-round w3-yellow"
                                style="width:{{ round((\App\Models\Invoice::where('valueStatus', '=', 3)->count() / \App\Models\Invoice::count()) * 100) }}%">
                                {{ round((\App\Models\Invoice::where('valueStatus', '=', 3)->count() / \App\Models\Invoice::count()) * 100) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <label class="main-content-label">نسبة احصائية الفواتير</label>

                        <div>
                                                       {!! $barChart->render() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <label class="main-content-label">نسبة احصائية الفواتير</label>
                        <div>
                                                       {!! $pieChart->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<!--Internal  Chart.bundle js -->
@section('js')
    {{-- {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!} --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <script type="text/javascript" src="jscript/graph.js"></script>
    {{-- <script src="{{ URL::asset('assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <!-- Moment js -->
    <script src="{{ URL::asset('assets/plugins/raphael/raphael.min.js') }}"></script>
    <!--Internal  Flot js-->
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery.flot/jquery.flot.categories.js') }}"></script>
    <script src="{{ URL::asset('assets/js/dashboard.sampledata.js') }}"></script>
    <script src="{{ URL::asset('assets/js/chart.flot.sampledata.js') }}"></script>
    <!--Internal Apexchart js-->
    <script src="{{ URL::asset('assets/js/apexcharts.js') }}"></script>
    <!-- Internal Map -->
    <script src="{{ URL::asset('assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::asset('assets/js/modal-popup.js') }}"></script>
    <!--Internal  index js -->
    <script src="{{ URL::asset('assets/js/index.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.vmap.sampledata.js') }}"></script> --}}
@endsection
