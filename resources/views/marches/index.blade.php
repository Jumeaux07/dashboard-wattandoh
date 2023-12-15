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
                {{-- <a href="{{route('marches.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un Marché </button></a> --}}
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbbar -->

 <!-- Start Contentbar -->
 <div class="contentbar">

    <div class="col-lg-12" style="position: absolue;">
        <div class="card m-b-30">
            <div class="card-body">
                <div id="nestable-menu" class="button-list text-center mt-2">

                    <a href="{{route('marches.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter un Marché </button></a>

                    {{-- <button type="button" class="btn btn-danger-rgba" data-action="replace-item">Exporter</button> --}}



                    <form action="{{ Route('marchestrier.index') }}" method="GET" >

                        <div class="row">



                            <div class="form-group col-sm-6">
                                <label for="exampleInputPassword1">Statut <span class="text-danger" >*</span></label>
                                <select name="statut_generique" id=""class="form-control" id="exampleInputPassword1">
                                    <option value="">Tous</option>
                                    <option value="4">en Cours</option>
                                    <option value="1">Perdu</option>
                                    <option value="2">Conclu</option>



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
                            <th>Reference</th>
                            {{-- <th>date</th> --}}
                            <th>publication</th>
                            <th>client / tel</th>
                            <th>rendezvous_id</th>
                            <th>Statut</th>
                            <th>Date de creation</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($marches as $marche)
                                <tr>
                                    <td>{{$marche->reference}}</td>
                                    {{-- <td>{{$marche->date}}</td> --}}
                                    <td>{{$marche->publication->reference}}</td>
                                    <td>{{$marche->client->nom_prenoms}} / {{$marche->client->phone1}}</td>
                                    <td>{{$marche->rendezvous_id}}</td>
                                    @if ($marche->statut_generique_id == 4)
                                        <td><span class="badge badge-primary">en cours</span></td>
                                    @elseif ($marche->statut_generique_id == 2)
                                        <td><span class="badge badge-success">Conclu</span></td>
                                    @elseif ($marche->statut_generique_id == 1)
                                        <td><span class="badge badge-danger">Perdu</span></td>
                                    @endif
                                    <td>{{date('d-m-Y à H:i', strtotime($marche->created_at))}}</td>
                                    <td>
                                        <div class="single-dropdown">
                                            <div class="dropdown">

                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                                </button>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{route('marches.show',$marche->id )}}"> <i class="feather icon-eye"></i> Voir</a>
                                                    <a class="dropdown-item" href="{{route('marches.edit', $marche->id)}}"> <i class="feather icon-edit" ></i> Modifier</a>
                                                    @if ($marche->statut_generique_id == 4)
                                                    <a class="dropdown-item" href="{{route('marche.statutMarche',$marche->id )}}"> <i class="fa fa-toggle-off"></i> Perdu</a>
                                                    @endif
                                                    @if ($marche->statut_generique_id == 1)
                                                    <a class="dropdown-item" href="{{route('marche.statutMarche',$marche->id )}}"> <i class="fa fa-toggle-on"></i> Conclu</a>
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


