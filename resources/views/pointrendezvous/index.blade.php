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
                {{-- <a href="{{route('rendezvous.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un Rendez Vous</button></a> --}}
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbbar -->

 <!-- Start Contentbar -->
 <div class="contentbar">

    {{-- <div class="col-lg-12" style="position: absolue;">
        <div class="card m-b-30">
            <div class="card-body">
                <div id="nestable-menu" class="button-list text-center mt-2">

                    <a href="{{route('rendezvous.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un Rendez Vous</button></a>





                    <form action="{{ Route('rendezvoustrier.index') }}" method="GET" >

                        <div class="row">



                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Statut <span class="text-danger" >*</span></label>
                                <select name="statut_generique" id=""class="form-control" id="exampleInputPassword1">
                                    <option value="">Tous</option>
                                    <option value="3">Attente</option>
                                    <option value="4">en Cours</option>
                                    <option value="8 ">termine</option>
                                    <option value="5 ">repporté</option>
                                    <option value="6 ">annulé</option>
                                    <option value="7 ">effectué</option>


                                </select>
                            </div>


                        </div>
                        <button type="submit" class="btn btn-primary-rgba" data-action="expand-all">Recherche Trier </button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}


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
                            <th>Reference Rapport</th>
                            <th>Statut du rapport</th>
                            <th>Reference du rendez vous </th>
                            <th>Etat du rendez vous</th>
                            <th>Date de creation du rapport</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach ($rendezvous as $rendezvou)
                            @foreach ($rapports as $rapport )
                            <tr>
                                <td>{{ $rapport->reference }}</td>
                                  @if ($rapport->statut_generique_id == 2)
                                    <td><span class="badge badge-success">Actif</span></td>
                                @elseif ($rapport->statut_generique_id == 1)
                                    <td><span class="badge badge-danger">Désactivé</span></td>
                                @endif
                            </tr>

                        @endforeach
                                <tr>
                                    <td>{{$rendezvou->reference}}</td>
                                    @if ($rendezvou->statut_generique_id == 3)
                                        <td><span class="badge badge-primary">Attente</span></td>
                                        @elseif ($rendezvou->statut_generique_id == 4)
                                            <td><span class="badge badge-secondary">en Cours</span></td>
                                        @elseif ($rendezvou->statut_generique_id == 5)
                                            <td><span class="badge badge-warning">repporté</span></td>
                                        @elseif ($rendezvou->statut_generique_id == 6)
                                            <td><span class="badge badge-danger">annulé </span></td>
                                        @elseif ($rendezvou->statut_generique_id == 7)
                                            <td><span class="badge badge-dark">effectué </span></td>
                                        @elseif ($rendezvou->statut_generique_id == 8)
                                        <td><span class="badge badge-success">termine</span></td>
                                    @endif
                                    <td>{{date('d-m-Y à H:i', strtotime($rendezvou->created_at))}}</td>
                                    <td>
                                        <div class="single-dropdown">
                                            <div class="dropdown">

                                                {{-- <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                                </button>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{route('rendezvous.show',$rendezvou->id )}}"> <i class="feather icon-eye"></i> Voir</a>
                                                    <a class="dropdown-item" href="{{route('rendezvous.edit', $rendezvou->id)}}"> <i class="feather icon-edit" ></i> Modifier</a>
                                                    @if ($rendezvou->statut_generique_id == 3)
                                                    <a class="dropdown-item" href="{{route('rendezvous.statutRendezvous',$rendezvou->id )}}"> <i class="fa fa-toggle-off"></i> en cours</a>
                                                    @endif
                                                    @if ($rendezvou->statut_generique_id == 4)
                                                    <a class="dropdown-item" href="{{route('rendezvous.statutRendezvous',$rendezvou->id )}}"> <i class="fa fa-toggle-off"></i> repporté</a>
                                                    @endif

                                                    @if ($rendezvou->statut_generique_id == 5)
                                                    <a class="dropdown-item" href="{{route('rendezvous.statutRendezvous',$rendezvou->id )}}"> <i class="fa fa-toggle-off"></i> annulé</a>
                                                    @endif
                                                    @if ($rendezvou->statut_generique_id == 6)
                                                    <a class="dropdown-item" href="{{route('rendezvous.statutRendezvous',$rendezvou->id )}}"> <i class="fa fa-toggle-off"></i> effectué </a>
                                                    @endif
                                                    @if ($rendezvou->statut_generique_id == 7)
                                                    <a class="dropdown-item" href="{{route('rendezvous.statutRendezvous',$rendezvou->id )}}"> <i class="fa fa-toggle-off"></i>termine </a>
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


