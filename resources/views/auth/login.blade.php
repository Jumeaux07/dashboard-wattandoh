<!DOCTYPE html>
<html lang="FR">

<!-- Mirrored from themesbox.in/admin-templates/orbiter/html/light-vertical/user-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Apr 2023 16:33:32 GMT -->
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Orbiter is a bootstrap minimal & clean admin template">
    <meta name="keywords" content="admin, admin panel, admin template, admin dashboard, responsive, bootstrap 4, ui kits, ecommerce, web app, crm, cms, html, sass support, scss">
    <meta name="author" content="Themesbox">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Connexion | Gestionnaire</title>
    <!-- Fevicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/watta.png')}}">
    <!-- Start css -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <!-- End css -->
</head>
<body class="vertical-layout">
    <!-- Start Containerbar -->
    <div id="containerbar" class="containerbar authenticate-bg">
        <!-- Start Container -->
        <div class="container">
            <div class="auth-box login-box">
                <!-- Start row -->
                <div class="row no-gutters align-items-center justify-content-center">
                    <!-- Start col -->
                    <div class="col-md-6 col-lg-5">
                        <!-- Start Auth Box -->
                        <div class="auth-box-right">
                            <div class="card">
                                <div class="card-body">
                                    @include('flashmessage')
                                    <form action="{{route('login.admin')}}" method="post" >
                                        @csrf
                                        <div class="form-head">

                                            <a href="#" class="logo"><img src="{{asset('assets/images/Wattandoh.png')}}" class="img-fluid" alt="logo"></a>
                                        </div>
                                        <h4 class="text-primary my-4">Connexion</h4>
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="username" name="email" placeholder="Entrez le mail de l'utilisateur ici..." required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Entrez le mot de passe ici..." required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-row mb-3">
                                        </div>
                                      <button type="submit" class="btn btn-success btn-lg btn-block font-18">Connexion</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- End Auth Box -->
                    </div>
                    <!-- End col -->
                </div>
                <!-- End row -->
            </div>
        </div>
        <!-- End Container -->
    </div>
    <!-- End Containerbar -->
    <!-- Start js -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
    <script src="{{asset('assets/js/detect.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <!-- End js -->
</body>

<!-- Mirrored from themesbox.in/admin-templates/orbiter/html/light-vertical/user-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 14 Apr 2023 16:33:32 GMT -->
</html>
