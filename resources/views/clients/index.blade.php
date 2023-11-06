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
                <a href="{{route('clients.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un client</button></a>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbbar -->

 <!-- Start Contentbar -->
 <div class="contentbar">


    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div id="nestable-menu" class="button-list text-center mt-2">
                    {{-- <button type="button" class="btn btn-primary-rgba" data-action="expand-all">Recherche</button> --}}


                    {{-- <button type="button" class="btn btn-success-rgba" data-action="add-item">Trier le resultat</button> --}}
                    {{-- <button class="btn btn-success-rgba"  type="button" id="widgetHod" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Trier le resultat</button>
                        <div class="dropdown-menu " aria-labelledby="widgetHod">
                            <a class="dropdown-item font-13" href="#">Sexe</a>
                            <a class="dropdown-item font-13" href="#">Statut</a>
                            <a class="dropdown-item font-13" href="#">Etat</a>
                            <ul class="vertical">
                                <a href="javaScript:void();">
                                    <i class="dripicons-user-group"></i><span>Utilisateurs</span><i class="feather icon-chevron-right pull-right"></i>
                                </a>
                                <ul class="vertical-submenu">
                                    <li><a >Administrateurs</a></li>
                                    <li><a href="{{Route('annonceurs.index')}}">Annonceurs <i class="ion ion-ios-person"></i></a></li>
                                    <li><a href="{{Route('clients.index')}}">Clients <i class="fa fa-users"></i></a></li>
                                    <li><a href="{{ Route('gestionnaires.index') }}">Gestionnaires</a></li>
                                </ul>
                            </ul>
                            <ul>
                                <li><a href="#">pays</a></li>
                            </ul>
                            <li>
                                <ul>ville</ul>
                            </li>
                            <a class="dropdown-item font-13"  id="widgetHod" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">test</a>
                            <div class="dropdown-menu " aria-labelledby="widgetHod">
                                <a class="dropdown-item font-13" href="#">Homme</a>
                                <a class="dropdown-item font-13" href="#">Femme</a>
                            </div>
                        </div> --}}
                        {{-- <a href="{{route('annonceurs.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un annonceur</button></a> --}}
                        {{-- <a href="{{route('gestionnaires.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un gestionnaire</button></a> --}}
                        <a href="{{route('clients.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un client</button></a>
                    {{-- <button type="button" class="btn btn-danger-rgba" data-action="replace-item">Exporter</button> --}}




                    <form action="{{ Route('clienttrier.index') }}" method="GET" >

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Sexe <span class="text-danger" >*</span> </label>
                                <select name="sexe" id=""class="form-control" id="exampleInputPassword1">
                                    <option value="">Tous</option>
                                    <option value="M">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Etat <span class="text-danger" >*</span></label>

                                <select name="statut_generique" id=""class="form-control" id="exampleInputPassword1">
                                    <option value="">Tous</option>
                                    <option value="2">Actif</option>
                                    <option value="1 ">Desactivé</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary-rgba" data-action="expand-all">Recherche Trier </button>
                    </form>
                </div>
            </div>
        </div>
    </div>



        <div class="card m-b-30">
            <div class="card-header">
                <h5 class="card-title">{{ $subtitle ?? '' }}</h5>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle">Exportez les données vers Copy, CSV, Excel & Note.</h6>
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Sexe</th>
                            <th>Nom & prénoms</th>
                            <th>Telephone 1</th>
                            <th>Téléphone 2</th>
                            {{-- <th>Sexe</th> --}}
                            <th>Etat</th>
                            <th>Date de creation</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    @if ($client->sexe == "F")
                                        <td><span class="badge badge-pink">Femme</span></td>
                                    @elseif ($client->sexe == "M")
                                        <td><span class="badge badge-primary">Homme</span></td>
                                    @endif
                                    <td>{{$client->nom_prenoms}}</td>
                                    <td>{{$client->phone1}}</td>
                                    <td>{{$client->phone2}}</td>
                                    {{-- <td>{{$client->sexe}}</td> --}}
                                    @if ($client->statut_generique_id == 2)
                                        <td><span class="badge badge-success">Actif</span></td>
                                    @elseif ($client->statut_generique_id == 1)
                                        <td><span class="badge badge-danger">Désactivé</span></td>
                                    @endif
                                    <td>{{date('d-m-Y à H:i', strtotime($client->created_at))}}</td>
                                    <td>
                                        <div class="single-dropdown">
                                            <div class="dropdown">

                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                                </button>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{route('clients.show',$client->id )}}"> <i class="feather icon-eye"></i> Voir</a>
                                                    <a class="dropdown-item" href="{{route('clients.edit', $client->id)}}"> <i class="feather icon-edit" ></i> Modifier</a>
                                                    @if ($client->statut_generique_id == 2)
                                                    <a class="dropdown-item" href="{{route('client.cliStatut',$client->id )}}"> <i class="fa fa-toggle-off"></i> Desactiver</a>
                                                    @endif
                                                    @if ($client->statut_generique_id == 1)
                                                    <a class="dropdown-item" href="{{route('client.cliStatut',$client->id )}}"> <i class="fa fa-toggle-on"></i> Activer</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
 </div>
@endsection


