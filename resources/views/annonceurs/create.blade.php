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
            <form action="{{route('annonceurs.store')}}" method="post" >
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Nom & prenoms  <span class="text-danger" >*</span> </label>
                        <input type="text" name="nom_prenoms" value="{{old('nom_prenoms')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: Kouassi Yves">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    {{-- <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Email <span class="text-danger" >*</span></label>
                        <input type="email" name="email" value="{{old('email')}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: asde@gmail.com">
                    </div> --}}

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Numéro de téléphone 1  <span class="text-danger" >*</span> </label>
                        <input type="text" name="phone1" value="{{old('phone1')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 0102030405">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Numéro de téléphone 2  <span class="text-danger" >*</span> </label>
                        <input type="text" name="phone2" value="{{old('phone2')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 0102030405">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    {{-- <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Adresse <span class="text-danger" >*</span></label>
                        <input type="text" name="adresse" value="{{old('adresse')}}" class="form-control" id="exampleInputPassword1" placeholder="Cocody Angre">
                    </div> --}}
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Sexe  <span class="text-danger" >*</span> </label>
                        {{-- <input type="text" name="sexe" value="{{old('sexe')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: Masculin "> --}}
                        <select name="sexe" id="" class="form-control">
                            <option value="" selected>Choisir le Sexe:</option>
                            <option value="F" selected>Feminin</option>
                            <option value="M" selected>Masculin</option>
                        </select>
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Mot de passe  <span class="text-danger" >*</span> </label>
                        <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="XXXXXXX">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Confirmation <span class="text-danger" >*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="XXXXXXX">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
 </div>
@endsection
