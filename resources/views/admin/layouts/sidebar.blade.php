<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav slimscrollsidebar">
        <div class="sidebar-head">
            <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div><img src="/img/no-avatar.png" alt="user-img" class="img-circle"></div>
                <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@if(isset($user) && $user['username']){{ucfirst($user['username'])}}@endif<span class="caret"></span></a>
                <ul class="dropdown-menu animated flipInY">
                    <li><a href="/admin/profile"><i class="ti-user"></i> Profilim</a></li>
                    <li><a href="/" target="_blank"><i class="ti-home"></i> Ön Siteye Git</a></li>
                    <li><a href="/admin/profile"><i class="ti-settings"></i> Kullanıcı Ayarları</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        <ul class="nav" id="side-menu">
            <li> <a href="/admin/dashboard"><i class="mdi mdi-av-timer fa-fw"></i><span class="hide-menu">Dashboard</span></a> </li>
            <li> <a href="/admin/intents"><i class="ti-layout-list-thumb fa-fw"></i><span class="hide-menu">Intent</span></a> </li>

            <li class="devider"></li>
            <li><a href="/logout" class="waves-effect"><i class="mdi mdi-logout fa-fw"></i> <span class="hide-menu">Logout</span></a></li>
        </ul>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Left Sidebar -->
<!-- ============================================================== -->