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
                {{-- <a href="{{route('annonceurs.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un annonceur</button></a> --}}
            </div>
        </div>
    </div>
</div>




 <div class="contentbar">


    <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-body">
                <div id="nestable-menu" class="button-list text-center mt-2">
                    {{-- <button type="button" class="btn btn-primary-rgba" data-action="expand-all">Recherche</button> --}}
                    {{-- <a href="{{route('annonceurs.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un annonceur</button></a> --}}
                    <div class="form-group col-sm-6">
                        <h2 for="exampleInputEmail1">La liste des Rendez vous de l'annonceur : <span style="text-transform:uppercase;">{{$annonceur->nom_prenoms}}</span> </h2>

                     </div>

                    {{-- <button type="button" class="btn btn-success-rgba" data-action="add-item">Trier le resultat</button> --}}


                        {{-- <button class="btn btn-success-rgba"  type="button" id="widgetHod" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Trier le resultat</button>
                        <div class="dropdown-menu " aria-labelledby="widgetHod">


                                <ul class="menu-principal" aria-labelledby="widgetHod">
                                    <li class="menu-item"><a href="#" class="dropdown-item font-13">Sexe<span class="submenu-icon">&#9658;</span></a>
                                        <ul class="sous-menu" aria-labelledby="widgetHod">
                                            <li class="menu-item has-submenu"><a href="#" class="dropdown-item font-13">Homme</a></li>
                                            <li class="menu-item has-submenu"><a href="#" class="dropdown-item font-13">Femme</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <a class="dropdown-item font-13" href="#">Statut</a>
                                <a class="dropdown-item font-13" href="#">Etat</a>

                        </div> --}}


                    {{-- <form action="{{ Route('annonceurtrier.index') }}" method="GET" >

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
                                <label for="exampleInputEmail1">Statut  <span class="text-danger" >*</span> </label>
                                <select name="parrain" id=""class="form-control" id="exampleInputPassword1">
                                    <option value="">Tous</option>

                                    <option value="Aucun">Aucun</option>

                                    <option value="Parrain">Parain</option>


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
                    </form> --}}



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
                            <th>Clients</th>
                            <th>Reference rdv</th>
                            <th>Date RDV</th>
                            <th>Reference Pub</th>
                            <th>Statut</th>
                            <th>Date de prise de rendez vous</th>

                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($annonceur->rdv as $rdvs)
                                <tr>
                                    <td>{{$rdvs->client->nom_prenoms}}</td>
                                    <td>{{ $rdvs->reference }}</td>
                                    <td>{{ $rdvs->date }}</td>
                                    <td>{{$rdvs->publication->reference}}</td>
                                    @if ($rdvs->statut_generique_id == 3)

                                        <td><span class="badge badge-primary">Attente</span></td>
                                        @elseif ($rdvs->statut_generique_id == 4)
                                            <td><span class="badge badge-secondary">en Cours</span></td>
                                        @elseif ($rdvs->statut_generique_id == 5)
                                            <td><span class="badge badge-warning">repporté</span></td>
                                        @elseif ($rdvs->statut_generique_id == 6)
                                            <td><span class="badge badge-danger">annulé </span></td>
                                        @elseif ($rdvs->statut_generique_id == 7)
                                            <td><span class="badge badge-dark">effectué </span></td>
                                        @elseif ($rdvs->statut_generique_id == 8)
                                        <td><span class="badge badge-success">termine</span></td>
                                    @endif
                                    <td>{{date('d-m-Y à H:i', strtotime($rdvs->created_at))}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
 </div>
@endsection


