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
                        <h3 class="box-title">Total Intent</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-success"></i> <span class="counter text-success">{{$total_C['intent']}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Total Message</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash3"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-info"></i> <span class="counter text-info">{{$total_C['message']}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Total Seen</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash2"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span class="counter text-purple">{{$total_C['seen']}}</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info">
                        <h3 class="box-title">Total UNSUCCESS</h3>
                        <ul class="list-inline two-part">
                            <li>
                                <div id="sparklinedash4"></div>
                            </li>
                            <li class="text-right"><i class="ti-arrow-up text-danger"></i> <span class="text-danger">{{$total_C['unsuccess_c']}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--/.row -->
            <!--row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="font-bold"> What is Chatbot? </a> </h4> </div>
                            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                                <div class="panel-body">
                                    It is an assistant that communicates with us through text messages, a virtual companion that integrates into websites, applications or instant messengers and helps entrepreneurs to get closer to customers. Such a bot is an automated system of communication with users.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingTwo">
                                <h4 class="panel-title"> <a class="collapsed font-bold" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" > What is working logic of Chatbot? </a> </h4> </div>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                <div class="panel-body">
                                    Main working logic on Chatbot is creation a system for that answering users to their question automatically. For that we create Intent logic for taking and responding answer to user. Intent is a simply a capsule that include many variable like question that comes from user. Chatbot system matches this questions and send answer to user due to that intent.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingThree">
                                <h4 class="panel-title"> <a class="font-bold collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree" > How to create Intent? </a> </h4> </div>
                            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                <div class="panel-body">
                                    It is so easy to create intent for chatbot. Just click button that placed on left menu and click add button. After that insert requested form for creation intent. After save the form your intent has been successfully created. You can test it from front site.
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading" role="tab" id="headingFour"> <a class="collapsed font-bold panel-title" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour"> How to test Chatbot? </a> </div>
                            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                                <div class="panel-body">
                                    You can easy start to use chatbot by going on to front site of system. You can reach front site with links that has been placed in navbar menues like top and left. Also you can go there from
                                    <a target="_blank" href="/">here</a>.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-4 col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title">Recent Messages</h3>
                        <div class="comment-center p-t-10">
                            <div class="comment-body">
                                <div class="user-img"> <img src="/img/no-avatar.png" alt="user" class="img-circle"> </div>
                                <div class="mail-contnet">
                                    <h5>Chatbot User</h5>
                                    <span class="time">16:25:03   20  may 2018</span> <span class="label label-rouded label-success">REPLIED</span>
                                    <br/><span class="mail-desc">Merhaba, sorun bildirmek istiyordum.</span>
                                </div>
                            </div>
                            <div class="comment-body b-none">
                                <div class="user-img"> <img src="/img/no-avatar.png" alt="user" class="img-circle"> </div>
                                <div class="mail-contnet">
                                    <h5>Chatbot User</h5>
                                    <span class="time">18:45:56   20  may 2018</span> <span class="label label-rouded label-success">REPLIED</span>
                                    <br/><span class="mail-desc">Hava durumu nedir?</span>
                                </div>
                            </div>
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
