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
                    <li class="breadcrumb-item"><a href="#">{{ $menu ?? '' }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $subtitle ?? '' }}</li>
                </ol>
            </div>
        </div>
        <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <a href="{{route('gestionnaires.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un gestionnaire</button></a>
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
                            <a class="dropdown-item font-13" href="#">Adresse</a>

                        </div> --}}
                        <a href="{{route('gestionnaires.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un gestionnaire</button></a>
                    {{-- <button type="button" class="btn btn-danger-rgba" data-action="replace-item">Exporter</button> --}}



                    {{-- <div class="col-3">
                        <div class="dropdown">
                            <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetHod" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i>a</button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetHod">
                                <a class="dropdown-item font-13" href="#">Refresh</a>
                                <a class="dropdown-item font-13" href="#">Export</a>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="dropdown">
                        <button class="btn btn-link p-0 font-18 float-right" type="button" id="widgetHod" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal-"></i>a</button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="widgetHod">
                            <a class="dropdown-item font-13" href="#">Refresh</a>
                            <a class="dropdown-item font-13" href="#">Export</a>
                        </div>
                    </div> --}}

                     <form action="{{ Route('gestionnairetrier.index') }}" method="GET" >

                        <div class="row">
                            {{-- <div class="form-group col-sm-6">
                                <label for="exampleInputEmail1">Sexe <span class="text-danger" >*</span> </label>
                                <select name="sexe" id=""class="form-control" id="exampleInputPassword1">
                                    <option value="">Tous</option>
                                    <option value="M">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                            </div> --}}
                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Statut <span class="text-danger" >*</span></label>

                                <select name="role" class="form-control" id="exampleInputPassword1">
                                    <option value="">Tous</option>
                                    <option value="3">Gest Client</option>
                                    <option value="2">Gest Annonceur</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Adresse <span class="text-danger" >*</span></label>

                                {{-- <select name="adresse" id=""class="form-control" id="exampleInputPassword1">
                                    <option value="">Tous</option>
                                    <option value="2">Actif</option>
                                    <option value="1 ">Desactivé</option>
                                </select> --}}
                                <input type="text" name="adresse" class="form-control" id="exampleInputPassword1">
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
                            <th>Statut</th>
                            <th>Nom & prénoms</th>
                            {{-- <th>Email</th> --}}
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Etat</th>

                            <th>Date de creation</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($gestionnaires as $gestionnaire)
                                <tr>
                                    {{-- <td><span class="badge badge-warning">{{$gestionnaire->role->libelle }}</span></td> --}}
                                   {{-- @foreach ($roles as $role )
                                   @if ($role->id == 3)
                                   <td><span class="badge badge-warning">{{ $gestionnaire->role->libelle }} </span></td>

                                   @elseif ($role->id == 2)
                                   <td><span class="badge badge-primary">{{ $gestionnaire->role->libelle }}</span></td>

                                   @endif

                                   @endforeach --}}

                                    @if ($gestionnaire->role_id == 3)
                                        <td><span class="badge badge-warning">{{ $gestionnaire->role->libelle }} </span></td>
                                    @elseif ($gestionnaire->role_id == 2 )
                                        <td><span class="badge badge-primary">{{ $gestionnaire->role->libelle }}</span></td>
                                    @endif


                                    <td>{{$gestionnaire->nom_prenoms}}</td>
                                    {{-- <td>{{$gestionnaire->email}}</td> --}}
                                    <td>{{$gestionnaire->telephone}}</td>
                                    <td>{{$gestionnaire->adresse}}</td>
                                    @if ($gestionnaire->statut_generique_id == 2)
                                        <td><span class="badge badge-success">Actif</span></td>
                                    @elseif ($gestionnaire->statut_generique_id == 1)
                                        <td><span class="badge badge-danger">Désactivé</span></td>
                                    @endif




                                    {{-- @if ($gestionnaire->role_id == 2)
                                        <td><span class="badge badge-success">gest Client </span></td>
                                    @elseif ($gestionnaire->role_id == 3)
                                        <td><span class="badge badge-danger">gest annonceur</span></td>
                                    @endif --}}

                                    <td>{{date('d-m-Y à H:i', strtotime($gestionnaire->created_at))}}</td>
                                    <td>
                                        <div class="single-dropdown">
                                            <div class="dropdown">

                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                                </button>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{route('gestionnaires.show',$gestionnaire->id )}}"> <i class="feather icon-eye"></i> Profil</a>
                                                    <a class="dropdown-item" href="{{route('gestionnaires.edit', $gestionnaire->id)}}"> <i class="feather icon-edit" ></i> Modifier</a>
                                                    @if ($gestionnaire->statut_generique_id == 2)
                                                    <a class="dropdown-item" href="{{route('gestionnaire.statutG',$gestionnaire->id )}}"> <i class="fa fa-toggle-off"></i> Desactiver</a>
                                                    @endif
                                                    @if ($gestionnaire->statut_generique_id == 1)
                                                    <a class="dropdown-item" href="{{route('gestionnaire.statutG',$gestionnaire->id )}}"> <i class="fa fa-toggle-on"></i> Activer</a>
                                                    @endif
                                                    <a class="dropdown-item"href="#"><i class="feather icon-eye"></i> Gerer</a>


                                                    {{-- @if ($gestionnaire->role_id == 3)
                                                    <a class="dropdown-item" href="{{route('gestionnaire.rAdmin',$gestionnaire->id )}}"> <i class="fa fa-toggle-off"></i>{{ $gestionnaire->role->libelle }}</a>
                                                    @endif
                                                    @if ($gestionnaire->role_id == 2)
                                                    <a class="dropdown-item" href="{{route('gestionnaire.rAdmin',$gestionnaire->id )}}"> <i class="fa fa-toggle-on"></i> {{ $gestionnaire->role->libelle }}</a>
                                                    @endif --}}
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


