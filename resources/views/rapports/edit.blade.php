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
            <form action="{{route('rapports.update', $rapport->id)}}" method="post" >
                @method('put')
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Reference  <span class="text-danger" >*</span> </label>
                        <input type="text" name="reference" value="{{$rapport->reference}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: jour....">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Nom Prenoms  <span class="text-danger" >*</span> </label>
                        <input type="text" name="nom_prenoms" value="{{$rapport->nom_prenoms}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: jour....">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Telephone  <span class="text-danger" >*</span> </label>
                        <input type="text" name="telephone" value="{{$rapport->telephone}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: jour....">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Loyer  <span class="text-danger" >*</span> </label>
                        <input type="text" name="loyer" value="{{$rapport->loyer}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: jour....">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Commission  <span class="text-danger" >*</span> </label>
                        <input type="text" name="commission" value="{{$rapport->commission}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: jour....">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Pourcentage  <span class="text-danger" >*</span> </label>
                        <input type="text" name="pourcentage" value="{{$rapport->pourcentage}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: jour....">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Date   <span class="text-danger" >*</span> </label>
                        <input type="date" name="date" value="{{$rapport->date}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: jour....">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Annonceurs  <span class="text-danger" >*</span> </label>
                        {{-- <input type="number" name="rendezvous_id" value="{{$marche->rendezvous_id}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 9999999999"> --}}
                        <select name="annonceur_id" class="form-control" id="exampleInputEmail1">
                            @foreach ($annonceurs as $annonceur )
                            <option value="{{$rapport->annonceur_id}}">{{ $annonceur->nom_prenoms }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Marches  <span class="text-danger" >*</span> </label>
                        {{-- <input type="number" name="rendezvous_id" value="{{$marche->rendezvous_id}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 9999999999"> --}}
                        <select name="marche_id" class="form-control" id="exampleInputEmail1">
                            @foreach ($marches as $marche )
                            <option value="{{$rapport->marche_id}}">{{ $marche->reference }}</option>
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
