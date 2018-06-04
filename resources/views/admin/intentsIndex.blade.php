@extends('admin.layouts.app')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Intents</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Admin</a></li>
                        <li class="active">Intents</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <div class="row">
                            <div class="col-lg-10">
                                <h3 class="box-title m-b-0">Intents</h3>
                                <p class="text-muted m-b-30">Intents that has been created for answering question due to Chatbot.</p>
                            </div>
                            <div class="col-lg-2">
                                <a href="/admin/intent/add" class="btn btn-danger pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light">Add Intent</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="intentsTable" class="table table-striped">
                                <thead>
                                <tr>
                                    <th width="10%">Name</th>
                                    <th width="70%">Question</th>
                                    <th width="10%">Type</th>
                                    <th width="10%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($intents as $intent)
                                <tr>
                                    <td>@if($intent && isset($intent['name'])){{strtoupper($intent['name'])}}@endif</td>
                                    <td>@if($intent && isset($intent['question'])){{ucfirst($intent['question'])}}@endif</td>
                                    <td>
                                        @if($intent && isset($intent['type']))
                                            @if($intent['type'] === 1)
                                                <span class="label label-rouded label-info">default</span>
                                            @endif

                                            @if($intent['type'] === 2)
                                                 <span class="label label-rouded label-success">welcome</span>
                                            @endif

                                            @if($intent['type'] === 3)
                                                <span class="label label-rouded label-denger">ending</span>
                                             @endif
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/admin/intent/edit/{{$intent['id']}}" class="btn btn-success btn-circle"><i class="fa fa-link"></i> </a>
                                        <a href="/admin/intent/edit/{{$intent['id']}}" class="btn btn-danger btn-circle"><i class="fa fa-times"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
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
        $(document).ready(function() {
            $('#intentsTable').DataTable(
            );
        });
    </script>
@endsection