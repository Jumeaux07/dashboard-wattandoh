@extends('themes.template')
@section('content')
    <!-- Start Breadcrumbbar -->
    <div class="breadcrumbbar">
        @include('flashmessage')
        <div class="row align-items-center">
            <div class="col-md-8 col-lg-8">
                <h4 class="page-title">{{ $module ?? '' }}</h4>
                <div class="breadcrumb-list">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                    </ol>
                </div>
            </div>
            {{-- <div class="col-md-4 col-lg-4">
                <div class="widgetbar">
                    <button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Actions</button>
                </div>
            </div> --}}
        </div>
    </div>
    <!-- End Breadcrumbbar -->
    <!-- Start Contentbar -->
    <div class="contentbar">
        <strong>Utilisateurs</strong>
        <hr>
        <div class="row">

            <div class="col-lg-6 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-5">
                                <span class="action-icon badge badge-primary-inverse mr-0"><i
                                        class="feather icon-user"></i></span>
                            </div>
                            <div class="col-7 text-right">
                                <h5 class="card-title font-14">Admintrateurs</h5>
                                <h4 class="mb-0">2585</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <span class="font-13">Aujouté aujourd'hui</span>
                            </div>
                            <div class="col-4 text-right">
                                <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i>25</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-5">
                                <span class="action-icon badge badge-primary-inverse mr-0"><i
                                        class="feather icon-user"></i></span>
                            </div>
                            <div class="col-7 text-right">
                                <h5 class="card-title font-14">Gestionnaire client</h5>
                                <h4 class="mb-0">2585</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <span class="font-13">Ajouté aujourd'hui</span>
                            </div>
                            <div class="col-4 text-right">
                                <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i>25</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-5">
                                <span class="action-icon badge badge-primary-inverse mr-0"><i
                                        class="feather icon-user"></i></span>
                            </div>
                            <div class="col-7 text-right">
                                <h5 class="card-title font-14">Gestionnaire annonceur</h5>
                                <h4 class="mb-0">2585</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <span class="font-13">Ajouté aujourd'hui</span>
                            </div>
                            <div class="col-4 text-right">
                                <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i>2</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-5">
                                <span class="action-icon badge badge-primary-inverse mr-0"><i
                                        class="feather icon-user"></i></span>
                            </div>
                            <div class="col-7 text-right">
                                <h5 class="card-title font-14">Total utilisateurs</h5>
                                <h4 class="mb-0">2585</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <span class="font-13">Ajouté aujourd'hui</span>
                            </div>
                            <div class="col-4 text-right">
                                <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i>25%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-5">
                                <span class="action-icon badge badge-primary-inverse mr-0"><i
                                        class="feather icon-user"></i></span>
                            </div>
                            <div class="col-7 text-right">
                                <h5 class="card-title font-14">Clients</h5>
                                <h4 class="mb-0">2585</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <span class="font-13">Ajouté aujourd'hui</span>
                            </div>
                            <div class="col-4 text-right">
                                <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i>25</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-5">
                                <span class="action-icon badge badge-primary-inverse mr-0"><i
                                        class="feather icon-user"></i></span>
                            </div>
                            <div class="col-7 text-right">
                                <h5 class="card-title font-14">Annonceurs</h5>
                                <h4 class="mb-0">2585</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <span class="font-13">Ajouté aujourd'hui</span>
                            </div>
                            <div class="col-4 text-right">
                                <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i>25</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- nombre de publication --}}
            <div class="col-lg-6 col-xl-3">
                <div class="card m-b-30">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-5">
                                <span class="action-icon badge badge-primary-inverse mr-0"><i
                                        class="feather icon-user"></i></span>
                            </div>
                            <div class="col-7 text-right">
                                <h5 class="card-title font-14">Nombre de Publication</h5>
                                <h4 class="mb-0">2585</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <span class="font-13">Ajouté aujourd'hui</span>
                            </div>
                            <div class="col-4 text-right">
                                <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i>25</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


                {{-- marche en cour  --}}
                <div class="col-lg-6 col-xl-3">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <span class="action-icon badge badge-primary-inverse mr-0"><i
                                            class="feather icon-user"></i></span>
                                </div>
                                <div class="col-7 text-right">
                                    <h5 class="card-title font-14">Marche en cours</h5>
                                    <h4 class="mb-0">2585</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <span class="font-13">Ajouté aujourd'hui</span>
                                </div>
                                <div class="col-4 text-right">
                                    <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i>25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- marche annuler --}}

                <div class="col-lg-6 col-xl-3">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <span class="action-icon badge badge-primary-inverse mr-0"><i
                                            class="feather icon-user"></i></span>
                                </div>
                                <div class="col-7 text-right">
                                    <h5 class="card-title font-14">Marche annulés ou perdu </h5>
                                    <h4 class="mb-0">2585</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <span class="font-13">Ajouté aujourd'hui</span>
                                </div>
                                <div class="col-4 text-right">
                                    <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i>25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- marche conclus  --}}

                <div class="col-lg-6 col-xl-3">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <span class="action-icon badge badge-primary-inverse mr-0"><i
                                            class="feather icon-user"></i></span>
                                </div>
                                <div class="col-7 text-right">
                                    <h5 class="card-title font-14">Marche conclus</h5>
                                    <h4 class="mb-0">2585</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <span class="font-13">Ajouté aujourd'hui</span>
                                </div>
                                <div class="col-4 text-right">
                                    <span class="badge badge-success"><i class="feather icon-trending-up mr-1"></i>25</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
    </div>
@endsection
