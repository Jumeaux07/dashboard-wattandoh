<div class="leftbar">
    <!-- Start Sidebar -->
    <div class="sidebar">
        <!-- Start Logobar -->
        <div class="logobar">
            <a href="index.html" class="logo logo-large"><img src="{{asset('assets/images/logo.svg')}}" class="img-fluid" alt="logo"></a>
            <a href="index.html" class="logo logo-small"><img src="{{asset('assets/images/small_logo.svg')}}" class="img-fluid" alt="logo"></a>
        </div>
        <!-- End Logobar -->
        <!-- Start Navigationbar -->
        <div class="navigationbar">
            <ul class="vertical-menu">
                <li>
                    <a href="javaScript:void();">
                      <img src="{{asset('assets/images/svg-icon/dashboard.svg')}}" class="img-fluid" alt="dashboard"><span>Dashboard</span><i class="feather icon-chevron-right pull-right"></i>
                    </a>
                    <ul class="vertical-submenu">
                        <li><a href="{{route('dashboard')}}">Tableau de bord</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javaScript:void();">
                        <i class="dripicons-user-group"></i><span>Utilisateurs</span><i class="feather icon-chevron-right pull-right"></i>
                    </a>

                    <ul class="vertical-submenu">
                        <li><a href="{{Route('administrateurs.index')}}">Administrateurs</a></li>
                        <li><a href="#">Annonceurs</a></li>
                        <li><a href="#">Clients</a></li>
                        <li><a href="#">Gestionnaires</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#">
                        <img src="{{asset('assets/images/svg-icon/settings.svg')}}" class="img-fluid" alt="widgets"><span>Paramettres</span><span class="badge badge-success pull-right">New</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Navigationbar -->
    </div>
    <!-- End Sidebar -->
</div>
