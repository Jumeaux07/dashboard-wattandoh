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
                    <a href="{{route('annonceurs.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un annonceur</button></a>


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


                    <form action="{{ Route('annonceurtrier.index') }}" method="GET" >

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
                                    {{-- @foreach ($statut_generiques as $statut_generique )
                                    <option value="{{ $statut_generique->id }}">{{ $statut_generique->description }}</option>
                                    @endforeach --}}
                                    <option value="2">Actif</option>
                                    <option value="1 ">Desactivé</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary-rgba" data-action="expand-all">Recherche Trier </button>
                    </form>


                    {{-- <button type="button" class="btn btn-danger-rgba" data-action="replace-item">Exporter</button> --}}

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
                            <th>Statut</th>
                            <th>Nom & prénoms</th>
                            <th>Telephone 1</th>
                            <th>Téléphone 2</th>
                            <th>Sexe</th>
                            {{-- <th>Statut</th> --}}
                            <th>Etat</th>
                            <th>Date de creation</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($annonceurs as $annonceur)
                                <tr>
                                    {{-- @if ($annonceur->parrainage_id == 3)
                                        <td><span class="badge badge-yellow">{{ $annonceur->parrainage->description }}</span></td>
                                        @elseif ($annonceur->parrainage_id == 1)
                                        <td><span class="badge badge-default"> {{ $annonceur->parrainage->description }} </span></td>
                                        @elseif ($annonceur->parrainage_id == 2)
                                        <td><span class="badge badge-warning"> {{ $annonceur->parrainage->description }}</span></td>
                                    @endif --}}
                                    @if  ($annonceur->parrain == "Parrain")
                                        <td><span class="badge badge-warning"> Parrain</span></td>
                                    @elseif($annonceur->parrain == "Aucun")
                                        <td><span class="badge badge-yellow">Aucun</span></td>
                                    @endif
                                    <td>{{$annonceur->nom_prenoms}}</td>
                                    <td>{{$annonceur->phone1}}</td>
                                    <td>{{$annonceur->phone2}}</td>
                                    {{-- <td>{{$annonceur->sexe}}</td> --}}
                                    @if ($annonceur->sexe == "F")
                                        <td><span class="badge badge-pink">Femme</span></td>
                                    @elseif ($annonceur->sexe == "M")
                                        <td><span class="badge badge-primary">Homme</span></td>
                                    @endif
                                    {{-- <td>{{$annonceur->parrain}}</td> --}}
                                    @if ($annonceur->statut_generique_id == 2)
                                        <td><span class="badge badge-success">Actif</span></td>
                                    @elseif ($annonceur->statut_generique_id == 1)
                                        <td><span class="badge badge-danger">Désactivé</span></td>
                                    @endif


                                    <td>{{date('d-m-Y à H:i', strtotime($annonceur->created_at))}}</td>
                                    <td>
                                        <div class="single-dropdown">
                                            <div class="dropdown">

                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                                </button>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{route('annonceurs.show',$annonceur->id )}}"> <i class="feather icon-user"></i> Profit</a>
                                                    <a class="dropdown-item" href="{{route('annonceurs.edit', $annonceur->id)}}"> <i class="feather icon-edit" ></i> Modifier</a>
                                                    @if ($annonceur->statut_generique_id == 2)
                                                    <a class="dropdown-item" href="{{route('annonceur.statutA',$annonceur->id )}}"> <i class="fa fa-toggle-off"></i> Desactiver</a>
                                                    @endif
                                                    @if ($annonceur->statut_generique_id == 1)
                                                    <a class="dropdown-item" href="{{route('annonceur.statutA',$annonceur->id )}}"> <i class="fa fa-toggle-on"></i> Activer</a>
                                                    @endif
                                                    {{-- @if ($annonceur->parrainage_id == 3)
                                                    <a class="dropdown-item" href="{{route('annonceur.ParrainA',$annonceur->id )}}"> <i class="fa fa-toggle-off"></i> Parrainé </a>
                                                    @endif
                                                    @if ($annonceur->parrainage_id == 1)
                                                    <a class="dropdown-item" href="{{route('annonceur.ParrainA',$annonceur->id )}}"> <i class="fa fa-toggle-on"></i> Parrain  </a>
                                                    @endif
                                                    @if ($annonceur->parrainage_id == 2)
                                                    <a class="dropdown-item" href="{{route('annonceur.ParrainA',$annonceur->id )}}"> <i class="fa fa-toggle-on"></i> Aucun</a>
                                                    @endif --}}
                                                    @if ($annonceur->parrain == "Aucun")
                                                    <a class="dropdown-item" href="{{route('annonceur.parrainage',$annonceur->id )}}"> <i class="fa fa-toggle-off"></i> Parrain </a>
                                                    @endif
                                                    @if ($annonceur->parrain == "Parrain")
                                                    <a class="dropdown-item" href="{{route('annonceur.parrainage',$annonceur->id )}}"> <i class="fa fa-toggle-on"></i>Aucun </a>
                                                    @endif
                                                    <a class="dropdown-item" href="{{route('annonceur.rendezvousParAnnonceur',$annonceur->id )}}"> <i class="fa fa-calendar-o"></i> Rendezvous</a>
                                                    <a class="dropdown-item" href="{{route('annonceur.PublicationParAnnonceur',$annonceur->id )}}"> <i class="fa fa-picture-o"></i> Publication</a>


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


