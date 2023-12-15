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
            <form action="{{route('annonceurs.update', $annonceur->id)}}" method="post" >
                @method('put')
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Nom & prenoms  <span class="text-danger" >*</span> </label>
                        <input type="text" name="nom_prenoms" value="{{$annonceur->nom_prenoms}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: Kouassi Yves">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1"> Numéro de téléphone 1<span class="text-danger" >*</span></label>
                        <input type="text"  name="phone1" value="{{$annonceur->phone1}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: asde@gmail.com">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Numéro de téléphone 2  <span class="text-danger" >*</span> </label>
                         <input type="text" name="phone2" value="{{$annonceur->phone2}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 0102030405">
                       {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Sexe <span class="text-danger" >*</span></label>
                        {{-- <input type="text" name="adresse" value="{{$annonceur->adresse}}" class="form-control" id="exampleInputPassword1" placeholder="Cocody Angre"> --}}
                        <select name="sexe" id="" class="form-control">
                            <option value="" selected>Choisir le Sexe:</option>
                            <option value="F" selected>Feminin</option>
                            <option value="M" selected>Masculin</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Statut <span class="text-danger" >*</span></label>
                        {{-- <input type="text" name="adresse" value="{{$annonceur->adresse}}" class="form-control" id="exampleInputPassword1" placeholder="Cocody Angre"> --}}
                        <select name="parrain" id="" class="form-control">
                            <option value="" selected>Choisir le statut:</option>
                            <option value="Parrain" selected>Parrain</option>
                            <option value="Aucun" selected>Aucun</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Mot de passe  <span class="text-danger" >*</span> </label>
                        <input type="password" name="password" @readonly(true) class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="XXXXXXX">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Confirmation <span class="text-danger" >*</span></label>
                        <input type="password" @readonly(true) name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="XXXXXXX">
                    </div>

                    {{-- <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Code parrainage <span class="text-danger" >*</span></label>

                        <select name="parrain" id="" class="form-control">

                            <option value="parrain" selected>Active</option>
                            <option value="pas parrain " selected>Desactiver</option>
                        </select>
                    </div> --}}

                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
 </div>
@endsection
