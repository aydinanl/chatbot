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
                        <div class="panel-heading">Inten Update</div>
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
                                <div class="row">

                                    <div class="row">
                                        <!-- Intent name -->
                                        <div class="col-sm-3 col-md-3 col-lg-3">
                                            <input type="text" class="form-control" id="add-intent-name" name="name" placeholder="Intent Name" value="@if(isset($intent) && $intent['name']){{$intent['name']}}@endif">
                                        </div>

                                        <!-- Intent type -->
                                        <div class="col-sm-2 col-md-2 col-lg-2">
                                            <select name="type" id="select-intent-type" class="form-control">
                                                <option value="1" @if($intent['type'] === 1) selected @endif >Default</option>
                                                <option value="2" @if($intent['type'] === 2) selected @endif >Welcome</option>
                                                <option value="3" @if($intent['type'] === 3) selected @endif >Ending</option>
                                            </select>
                                        </div>
                                        <!-- Intent save btn -->
                                        <div class="col-sm-1 col-md-1 pull-right">
                                            <button class="btn btn-primary pull-right" id="intent-update-button">Update Intent</button>
                                        </div>
                                    </div>
                                    <!-- What user says? (Define words) -->
                                    <div class="row m-t-15">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <input type="text" class="form-control" name="define_words" id="add-intent-define-words" placeholder="What user says?" value="@if($define_words){{$define_words}}@endif">
                                        </div>
                                    </div>



                                    <!-- Has operation -->
                                    <div class="row m-t-20">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label for="has-operation-check">Has operation?</label>
                                            <input id="has-operation-check" type="checkbox" name="has_operation">
                                        </div>
                                    </div>

                                    <div class="row" id="has-operation-form">
                                        <div class="col-sm-1 col-md-1 col-lg-1">
                                            <select name="operation_type" id="add-intent-operation-type" class="form-control">
                                                <option value="1" @if($intent['operation_type'] === 'GET') selected @endif>GET</option>
                                                <option value="2" @if($intent['operation_type'] === 'POST') selected @endif>POST</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-11 col-md-11 col-lg-11">
                                            <input type="text" class="form-control" name="operation_url" id="add-intent-operation-url" placeholder="Operation URL like (http://localhost:8020/api/get-time)" value="@if(isset($intent) && $intent['operation_url']){{$intent['operation_url']}}@endif">
                                        </div>
                                    </div>

                                    <div class="row" id="has-forward-form">
                                        <div class="col-sm-4 col-md-4 col-lg-4">
                                            <select name="select_forward" id="add-intent-forward-id" class="form-control">
                                                @foreach($intents as $intentT)
                                                    <option value="{{$intentT['id']}}">{{$intentT['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!--Output -->
                                    <div class="row m-t-15">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <input type="text" class="form-control" id="add-intent-output" name="output" placeholder="Output of intent as answering to question. You can use your variable or operation response with {il}, or {response.object}" value="@if(isset($intent) && $intent['output']){{$intent['output']}}@endif">
                                            <p class="text-muted m-t-10 m-l-10">
                                                If you take a variable from user, use <code>{variableName}</code> for give it back with to user.
                                                <br>
                                                If you use operation and that operation turns a response, you can give it back with <code>{response.returned.object}</code>.
                                            </p>
                                        </div>
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
        var has_operation = "{{$intent['has_operation']}}";
        var id = "{{$intent['id']}}";

        console.log(has_operation);
    </script>
    <script src="/jsPages/intentAddPage.js"></script>
@endsection