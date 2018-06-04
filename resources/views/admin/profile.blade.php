@extends('admin.layouts.app')
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Profil Sayfası</h4> </div>
                <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                    <ol class="breadcrumb">
                        <li><a href="/admin">Admin</a></li>
                        <li class="active">Profilim</li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <!-- .row -->
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="white-box">
                        <div class="user-bg"> <img width="100%" alt="user" src="/img/no-avatar.png">
                            <div class="overlay-box">
                                <div class="user-content">
                                    <a href="javascript:void(0)"><img src="/img/no-avatar.png" class="thumb-lg img-circle" alt="img"></a>
                                    <h4 class="text-white">@if(isset($user) && $user['fullname']){{$user['fullname']}}@endif</h4>
                                    <h5 class="text-white">@if(isset($user) && $user['email']){{$user['email']}}@endif</h5> </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="white-box">
                        <ul class="nav nav-tabs tabs customtab">
                            <li class="active tab">
                                <a href="#settings" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Profil Ayarları</span> </a>
                            </li>
                        </ul>
                        <div class="tab-content">

                            <div class="active tab-pane" id="settings">
                                <form class="form-horizontal form-material" action="/admin/profile" method="post">
                                    <div class="form-group">
                                        <label class="col-md-12">Ad Soyad</label>
                                        <div class="col-md-12">
                                            <input type="text" name="fullname" placeholder="Adınız Soyadınız" class="form-control form-control-line" value="@if(isset($user) && $user['fullname']){{$user['fullname']}}@endif">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" name="email" placeholder="Emailiniz" class="form-control form-control-line" value="@if(isset($user) && $user['email']){{$user['email']}}@endif">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Şifre</label>
                                        <div class="col-md-12">
                                            <input type="password" name="password" placeholder="******" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Bilgileri Güncelle</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
    </div>
@endsection