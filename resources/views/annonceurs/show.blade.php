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
                    <li class="breadcrumb-item"><a href="index.html">{{ $menu ?? '' }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <a href="{{back()->getTargetUrl()}}"><button class="btn btn-primary-rgba"><i class="dripicons-chevron-left"></i>Retour</button></a>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbbar -->

 <!-- Start Contentbar -->
 <div class="contentbar">
    <div class="card">
        <div class="container">
            <h1>Profil Annonceur</h1>
            <hr>

            <div class="row">
                <div class="col-md-4">
                    <!-- Photo de profil -->
                    <img src="{{asset('assets/images/users/profile.svg')}}" alt="Photo de profil" class="img-fluid rounded-circle">
                </div>
                <div class="col-md-8">
                    <!-- Informations utilisateur -->
                    <h3>{{$annonceur->nom_prenoms}}</h3>
                    <p>Numero de Telephone 1 : {{$annonceur->phone1}}</p>
                    <p>Numero de Telephone 2 : {{$annonceur->phone2}}</p>
                    <p>Sexe: {{$annonceur->sexe}}</p>
                    <p>Description : Compte annonceur.</p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <!-- Autres informations ou sections de la page de profil -->
                    <h3>Actions</h3>
                    <p>
                        <a href="{{route('annonceurs.edit',$annonceur->id)}}"><button class="btn btn-primary"><i class="feather icon-edit" ></i> <strong>Editer</strong> </button></a>
                        @if ($annonceur->statut_generique_id == 2)
                        <a href="{{route('annonceur.statutA',$annonceur->id )}}"><button class="btn btn-danger"><i class="fa fa-toggle-off"></i> <strong>Desactiver</strong></button></a>
                        @endif
                        @if ($annonceur->statut_generique_id == 1)
                        <a href="{{route('annonceur.statutA',$annonceur->id )}}"><button class="btn btn-success"><i class="fa fa-toggle-on"></i> <strong>Activer</strong></button></a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
 </div>

 @endsection
