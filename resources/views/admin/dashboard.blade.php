@extends('admin.layouts.app')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Home</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="#">Admin</a></li>
                        <li class="active">Home</li>
                    </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- ============================================================== -->
            <!-- Different data widgets -->
            <!-- ============================================================== -->
            <!-- .row -->
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Toplam Sayfa</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">115</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Toplam Yazı</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash3"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">2</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Toplam Görüntülenme</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash2"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">4</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Okunmamış İletişim</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash4"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-danger"></i> <span class="text-danger">5</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/.row -->
            <!--row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12 col-lg-8 col-sm-12 col-xs-12">
                    <div class="white-box">
                        <h3 class="box-title">Products Yearly Sales</h3>
                        <ul class="list-inline text-right">
                            <li>
                                <h5><i class="fa fa-circle m-r-5 text-info"></i>Mac</h5> </li>
                            <li>
                                <h5><i class="fa fa-circle m-r-5 text-inverse"></i>Windows</h5> </li>
                        </ul>
                        <div id="ct-visits" style="height: 405px;"></div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 col-sm-12 col-xs-12">
                    <div class="panel">
                        <div class="p-20">
                            <div class="row">
                                <div class="col-xs-8">
                                    <h4 class="m-b-0">Total Earnings</h4>
                                    <h2 class="m-t-0 font-medium">$580.50</h2>
                                </div>
                                <div class="col-xs-4 p-20">
                                    <select class="form-control">
                                        <option>DEC</option>
                                        <option>JAN</option>
                                        <option>FEB</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer bg-extralight">
                            <ul class="earning-box">
                                <li>
                                    <div class="er-row">
                                        <div class="er-pic"><img src="/plugins/images/users/genu.jpg" alt="varun" width="60" class="img-circle"></div>
                                        <div class="er-text">
                                            <h3>Andrew Simon</h3><span class="text-muted">10-11-2016</span></div>
                                        <div class="er-count ">$<span class="counter">46</span></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="er-row">
                                        <div class="er-pic"><img src="/plugins/images/users/govinda.jpg" alt="varun" width="60" class="img-circle"></div>
                                        <div class="er-text">
                                            <h3>Daniel Kristeen</h3><span class="text-muted">10-11-2016</span></div>
                                        <div class="er-count ">$<span class="counter">55</span></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="er-row">
                                        <div class="er-pic"><img src="/plugins/images/users/pawandeep.jpg" alt="varun" width="60" class="img-circle"></div>
                                        <div class="er-text">
                                            <h3>Chris gyle</h3><span class="text-muted">10-11-2016</span></div>
                                        <div class="er-count ">$<span class="counter">66</span></div>
                                    </div>
                                </li>
                                <li class="center">
                                    <a class="btn btn-rounded btn-info btn-block p-10">Withdrow money</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </div>
@endsection
@section('scripts')
    <script src="/js/dashboard1.js"></script>
@endsection
