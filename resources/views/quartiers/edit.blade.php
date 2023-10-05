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
        <div class="card-header">
            <h5 class="card-title" >{{$subtitle ?? ""}}</h5>
        </div>
        <div class="card-body">
            <h6 class="card-subtitle">Les champs qui sont marqués par ( <span class="text-danger" >*</span> ) sont  obigatoires</h6>
            <form action="{{route('quartiers.update', $quartier->id)}}" method="post" >
                @method('put')
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Quartier  <span class="text-danger" >*</span> </label>
                        <input type="text" name="libelle" value="{{$quartier->libelle}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex:toit rouge...">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Commune   <span class="text-danger" >*</span> </label>
                        {{-- <input type="text" name="commune_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex:toit rouge..."> --}}
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                        <select name="commune_id" id="exampleInputPassword1" class="form-control">
                            @foreach ($communes as $commune )
                            <option  value="{{$quartier->commune_id}}"> {{ $commune ->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
 </div>
@endsection
