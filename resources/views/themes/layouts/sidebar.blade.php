<div class="leftbar">
    <!-- Start Sidebar -->
    <div class="sidebar">
        <!-- Start Logobar -->
        <div class="logobar">
            <a href="{{route('dashboard')}}" class="logo logo-large"><img src="{{asset('assets/images/Wattandoh.png')}}" class="img-fluid" alt="logo"></a>
            <a href="{{route('dashboard')}}" class="logo logo-small"><img src="{{asset('assets/images/watta.png')}}" class="img-fluid" alt="logo"></a>
        </div>
        <!-- End Logobar -->
        <!-- Start Navigationbar -->
        <div class="navigationbar">
            <ul class="vertical-menu">
                <li>
                    <a href="javaScript:void();">
                      <img src="{{asset('assets/images/svg-icon/dashboard.svg')}}" class="img-fluid" alt="dashboard"><span>Acceuil</span><i class="feather icon-chevron-right pull-right"></i>
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
                        <li><a href="{{Route('annonceurs.index')}}">Annonceurs <i class="ion ion-ios-person"></i></a></li>
                        <li><a href="{{Route('clients.index')}}">Clients <i class="fa fa-users"></i></a></li>
                        <li><a href="{{ Route('gestionnaires.index') }}">Gestionnaires</a></li>



                    </ul>
                </li>

                <li>
                    <a href="javaScript:void();">
                        <i class="dripicons-user-group"></i><span>Rubriques</span><i class="feather icon-chevron-right pull-right"></i>
                    </a>
                    <ul class="vertical-submenu">

                        <li><a href="{{Route('publications.index')}}">Publications</a></li>
                        <li><a href="{{ Route('rendezvous.index') }}">Mes Rendez Vous </a></li>
                        <li><a href="{{ Route('marches.index') }}">Mes Marches <i class="feather icon-shopping-cart"></i> </a></li>

                    </ul>
                </li>
                <li>
                    <a href="javaScript:void();">
                        <i class="dripicons-user-group"></i><span>Rapports</span><i class="feather icon-chevron-right pull-right"></i>
                    </a>
                    <ul class="vertical-submenu">

                        <li><a href="#">Point des rendez-vous</a></li>
                        <li><a href="#">Rapport des Marches</a></li>
                        <li><a href="#">Recus</a></li>

                    </ul>
                </li>


                <li>
                    <a href="#">
                        <img src="{{asset('assets/images/svg-icon/settings.svg')}}" class="img-fluid" alt="widgets"><span>Paramettres</span><span class="badge badge-success pull-right">New</span>
                    </a>

                   <ul class="vertical-submenu">
                    <li><a href="{{ Route('budgets.index') }}">Budgets</a></li>
                    <li><a href="{{ Route('communes.index') }}">Communes</a></li>
                    <li><a href="{{ Route('quartiers.index') }}">Quartiers  </a></li>
                    <li><a href="{{ Route('images.index') }}">Mes Images  <i class="feather icon-image"></i></a></li>
                    <li><a href="{{ Route('typedebiens.index') }}"> Type de Bien </a></li>
                    <li><a href="{{ Route('rapports.index') }}"> Rapports </a></li>
                    <li><a href="{{ Route('interdits.index') }}"> Interdits </a></li>
                    <li><a href="{{ Route('typedemarches.index') }}"> Type de Marche </a></li>
                    <li><a href="{{ Route('otps.index') }}"> Otp </a></li>
                   </ul>
                </li>
                {{-- <li>
                    <a href="javaScript:void();">
                      <img src="{{ asset('assets/images/svg-icon/apps.svg') }}" class="img-fluid" alt="apps"><span>Parrainage </span><i class="feather icon-chevron-right pull-right"></i>
                    </a>
                    <ul class="vertical-submenu">

                        <li><a href="{{Route('CodeQR.index')}}">Code QR </a></li>

                    </ul>

                </li> --}}
            </ul>
        </div>
        <!-- End Navigationbar -->
    </div>
    <!-- End Sidebar -->
</div>
