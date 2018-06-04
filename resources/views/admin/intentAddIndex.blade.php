@extends('admin.layouts.app')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Intent</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Admin</a></li>
                        <li><a href="/admin/intents">Intents</a></li>
                        <li class="active">Intent</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Intent Creation</div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="row process-error">
                                    <div class="col-lg-12 col-sm-12 col-xs-12 m-b-20">
                                        <!-- Start an Alert -->
                                        <div style="padding: 10px" id="error-message" class="alert-danger"> <i class="fa fa-exclamation"></i> <span class="error-message"></span> </div>
                                    </div>
                                </div>
                                <div class="row process-success">
                                    <div class="col-lg-12 col-sm-12 col-xs-12 m-b-20">
                                        <!-- Start an Alert -->
                                        <div style="padding: 10px" id="error-message" class="alert-success"> <i class="fa fa-exclamation"></i>  <span class="success-message"></span> </div>
                                    </div>
                                </div>
                                <form action="#">

                                </form>
                                <div class="row">
                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                        <input type="text" class="form-control" id="add-product-name" placeholder="Intent Name">
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-2">
                                        <select name="" id="" class="form-control">
                                            <option value="1">Default</option>
                                            <option value="1">Welcome</option>
                                            <option value="1">Ending</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-1 col-md-1 pull-right">
                                        <button class="btn btn-success pull-right" id="product-add-button">Save Intent</button>
                                    </div>
                                </div>
                                <div class="row m-t-15">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="add-product-name" placeholder="What user says?">
                                    </div>
                                </div>

                                <!-- Has variable -->
                                <div class="row m-t-20">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <label for="has-variable-check">Has variable?</label>
                                        <input id="has-variable-check" type="checkbox">
                                    </div>
                                </div>

                                <div class="row" id="has-variable-form">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <input type="text" class="form-control" id="add-product-name" placeholder="Define variables with sperating (,) like il,ilce">
                                        <a class="btn btn-sm btn-success m-t-15 m-b-15" id="question-add-button">Add Question</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>

    </div>
@endsection
@section('scripts')
    <script src="/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script>
        var token = "{{$token}}";
    </script>
    <script src="/jsPages/intentAddPage.js"></script>
@endsection