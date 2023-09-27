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
            <form action="{{route('publications.store')}}" method="post" >
                {{ csrf_field() }}
                <div class="row">
                    {{-- <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Reference  <span class="text-danger" >*</span> </label>
                        <input type="text" name="reference" value="{{old('reference')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="00001azer">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div> --}}


                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Piece  <span class="text-danger" >*</span> </label>
                        <input type="number" name="piece" value="{{old('piece')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 0102030405">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Caution <span class="text-danger" >*</span></label>
                        <input type="number" name="caution" value="{{old('caution')}}" class="form-control" id="exampleInputPassword1" placeholder="XXXXXXXX">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">loyer <span class="text-danger" >*</span></label>
                        <input type="number" name="loyer" value="{{old('loyer')}}" class="form-control" id="exampleInputPassword1" placeholder="prix du bien mensuel">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Commission <span class="text-danger" >*</span></label>
                        <input type="number" name="commission" value="{{old('commission')}}" class="form-control" id="exampleInputPassword1" placeholder="XXX%">
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Annonceur <span class="text-danger" >*</span></label>
                        {{-- <input type="number" name="annonceur_id" value="{{old('annonceur_id')}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: Identifiant annonceur"> --}}
                        <select name="annonceur_id" id="exampleInputPassword1" class="form-control">
                            @foreach ($annonceurs as $annonceur )
                            <option value="{{ $annonceur->id }}">{{ $annonceur ->nom_prenoms }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Type de Marche <span class="text-danger" >*</span></label>
                        {{-- <input type="number" name="annonceur_id" value="{{old('annonceur_id')}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: Identifiant annonceur"> --}}
                        <select name="type_de_marche_id" id="exampleInputPassword1" class="form-control">
                            @foreach ($typedemarches as $typedemarche )
                            <option value="{{ $typedemarche->id }}">{{ $typedemarche ->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Interdit <span class="text-danger" >*</span></label>

                        <select name="interdit_id" id="exampleInputPassword1" class="form-control">
                            @foreach ($interdits as $interdit )
                            <option value="{{ $interdit->id }}">{{ $interdit ->libelle }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- <div class="form-group col-sm-6">
                        <label for="interdit_id">Interdit <span class="text-danger" >*</span></label>

                        <select name="interdit_id" id="interdit_id"  class="form-control" >
                            @foreach ($interdits as $interdit )
                            <option value="{{ $interdit->id }}">{{ $interdit->libelle }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Type de bien  <span class="text-danger" >*</span></label>

                        <select name="type_de_bien_id" id="exampleInputPassword1" class="form-control">
                            {{-- <select required class="form-select form-select-solid" data-control="select2" data-hide-search="true" multiple="multiple" data-placeholder="Selectionnez le(s) type(s) de biens..." name="typebiens[]" style=" background:rgba(209, 205, 205, 0.541);"> --}}
                            @foreach ($typedebiens as $typedebien )
                            <option value="{{ $typedebien->id }}">{{ $typedebien ->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-6 fv-row">
                        <label class="required text-black fs-6 fw-semibold mb-2"> TYPE DE BIENS (Slectionnez vos types de biens) </label>
                        <select required class="form-select form-select-solid" data-control="select2" data-hide-search="true" multiple="multiple" data-placeholder="Selectionnez le(s) type(s) de biens..." name="typebiens[]" style=" background:rgba(209, 205, 205, 0.541);">
                            @foreach ($typedebiens as $typebien)
                            <option value=" {{$typebien->id}}"> {{$typebien->designation}} </option>
                            @endforeach
                        </select>
                    </div> --}}


                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1"> Commune <span class="text-danger" >*</span></label>
                        {{-- <input type="number" name="commune_id" value="{{old('commune_id')}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: Identifiant commune"> --}}
                        <select name="commune_id" id="commune" class="form-control">
                            @foreach ($communes as $commune )
                            <option value="{{ $commune->id }}">{{ $commune ->libelle }}</option>

                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Quartier <span class="text-danger" >*</span></label>

                        <select name="quartier_id" id="quartier" class="form-control">
                            @foreach ($quartiers as $quartier )
                            <option value="{{ $quartier->id }}">{{ $quartier ->libelle }}</option>

                            @endforeach
                        </select>
                    </div>
                    <script>
                        document.getElementById('commune').addEventListener('change', function(){
                            var communeId = this.value;
                            fetch('/quartiers/' +communeId)
                               .then(response => response.json())
                               .then(data => {
                                var quartierSelect = document.getElementById('quartier');
                                 quartierSelect.innerHTML = ' ';// efface les options de la table quartiers
                                 data.forEach(quartier => {
                                    var option = document.createElement('option');
                                    option.value = quartier.id;
                                    option.text = quartier.libelle;
                                    quartierSelect.appendChild(option);


                                 });
                               })
                        });
                    </script>


                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1"> budget <span class="text-danger" >*</span></label>
                        {{-- <input type="number" name="budget_id" value="{{old('budget_id')}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: Identifiant budget"> --}}
                        <select name="budget_id" id="exampleInputPassword1" class="form-control">
                            @foreach ($budgets as $budget )
                            <option value="{{ $budget->id }}">{{ $budget ->max }}</option>
                            {{-- <option value="{{ $budget->id }}">{{ $budget ->min }}</option> --}}
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Description <span class="text-danger" >*</span></label><br>
                        {{-- <input type="text" name="description" value="{{old('description')}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: lze biens est situer......"> --}}
                        <textarea name="description" value=" {{old('description')}}" id="exampleInputPassword1" class="form-control"cols="70" rows="3" placeholder="le bien est situe ..."></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
 </div>
@endsection
