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
        {{-- <div class="col-md-4 col-lg-4">
            <div class="widgetbar">
                <a href="{{route('communes.create')}}"><button class="btn btn-primary-rgba"><i class="feather icon-plus mr-2"></i>Ajouter une commune </button></a>
            </div>
        </div> --}}
    </div>
</div>
<!-- End Breadcrumbbar -->

 <!-- Start Contentbar -->
 <div class="contentbar">
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
                            <th>Libelle </th>

                            <th>Statut</th>
                            <th>Date de creation</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($typedebiens as $typedebien)
                                <tr>
                                    <td>{{$typedebien->libelle}}</td>

                                    @if ($typedebien->statut_generique_id == 2)
                                        <td><span class="badge badge-success">Actif</span></td>
                                    @elseif ($typedebien->statut_generique_id == 1)
                                        <td><span class="badge badge-danger">Désactivé</span></td>
                                    @endif
                                    <td>{{date('d-m-Y à H:i', strtotime($typedebien->created_at))}}</td>
                                    <td>
                                        <div class="single-dropdown">
                                            <div class="dropdown">

                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                                </button>

                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{route('typedebiens.show',$typedebien->id )}}"> <i class="feather icon-eye"></i> Voir</a>
                                                    <a class="dropdown-item" href="{{route('typedebiens.edit', $typedebien->id)}}"> <i class="feather icon-edit" ></i> Modifier</a>
                                                    @if ($typedebien->statut_generique_id == 2)
                                                    <a class="dropdown-item" href="{{route('typedebien.statutTypedebien',$typedebien->id )}}"> <i class="fa fa-toggle-off"></i> Desactiver</a>
                                                    @endif
                                                    @if ($typedebien->statut_generique_id == 1)
                                                    <a class="dropdown-item" href="{{route('typedebien.statutTypedebien',$typedebien->id )}}"> <i class="fa fa-toggle-on"></i> Activer</a>
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


