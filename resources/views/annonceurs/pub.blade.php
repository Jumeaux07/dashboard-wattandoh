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
                        <h2 for="exampleInputEmail1">La liste des Publication de l'annonceur : <span style="text-transform:uppercase;">{{$annonceur->nom_prenoms}}</span> </h2>

                     </div>





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
                            <th>reference</th>

                            <th>Type de bien</th>
                            <th>Piece</th>
                            <th>Loyer</th>
                            <th>Caution</th>
                            <th>Zones</th>
                            <th>Etat</th>
                            <th>Date de Publication </th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($annonceur->publications as $publication)
                                <tr>
                                    <td>{{$publication->reference}}</td>
                                    {{-- <td>{{$publication->description}}</td> --}}
                                    <td>{{$publication->type_de_bien->libelle}}</td>
                                    <td>{{$publication->piece}}</td>
                                    <td>{{$publication->loyer}}</td>
                                    <td>{{$publication->caution}}</td>
                                    <td>{{$publication->commune->libelle}} / {{$publication->quartier->libelle}}</td>
                                    @if ($publication->statut_generique_id == 2)
                                            <td><span class="badge badge-success">Publier</span></td>
                                        @elseif ($publication->statut_generique_id == 1)
                                            <td><span class="badge badge-danger">Brouillons</span></td>
                                    @endif
                                    <td>{{date('d-m-Y à H:i', strtotime($publication->created_at))}}</td>

                                    <td>
                                        <div class="single-dropdown">
                                            <div class="dropdown">

                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                                </button>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{route('publications.show',$publication->id )}}"> <i class="feather icon-eye"></i> Voir</a>
                                                    {{-- <a class="dropdown-item" href="{{route('publications.edit', $publication->id)}}"> <i class="feather icon-edit" ></i> Modifier</a>
                                                    @if ($publication->statut_generique_id == 2)
                                                    <a class="dropdown-item" href="{{route('publication.statutPub',$publication->id )}}"> <i class="fa fa-toggle-off"></i> Brouillon</a>
                                                    @endif
                                                    @if ($publication->statut_generique_id == 1)
                                                    <a class="dropdown-item" href="{{route('publication.statutPub',$publication->id )}}"> <i class="fa fa-toggle-on"></i> Publier</a>
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


