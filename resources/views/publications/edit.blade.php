@extends('themes.template')
@section('content')

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
            <form action="{{route('publications.update', $publication->id)}}" method="post" >
                @method('put')
                {{ csrf_field() }}
                <div class="row">
                    {{-- <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">reference  <span class="text-danger" >*</span> </label>
                        <input type="text" name="reference" value="{{$publication->reference}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: Kouassi Yves">

                    </div> --}}

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Piece  <span class="text-danger" >*</span> </label>
                        <input type="number" name="piece" value="{{$publication->piece}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="999999999">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Caution <span class="text-danger" >*</span></label>
                        <input type="number" name="caution" value="{{$publication->caution}}" class="form-control" id="exampleInputPassword1" placeholder="99999999999">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">loyer <span class="text-danger" >*</span></label>
                        <input type="number" name="loyer" value="{{$publication->loyer}}" class="form-control" id="exampleInputPassword1" placeholder="prix du bien mensuel">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Commission <span class="text-danger" >*</span></label>
                        <input type="number" name="commission" value="{{$publication->commission}}" class="form-control" id="exampleInputPassword1" placeholder="XXX%">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Annonceur <span class="text-danger" >*</span></label>
                        {{-- <input type="number" name="annonceur_id" value="{{$publication->annonceur_id}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: Identifiant annonceur"> --}}
                        <select name="annonceur_id" id="exampleInputPassword1" class="form-control" value="{{$publication->annonceur_id}}">
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
                        {{-- <input type="number" name="annonceur_id" value="{{old('annonceur_id')}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: Identifiant annonceur"> --}}
                        <select name="interdit_id" id="exampleInputPassword1" class="form-control">
                            @foreach ($interdits as $interdit )
                                <option value="{{ $interdit->id }}">{{ $interdit ->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Type de bien <span class="text-danger" >*</span></label>
                        {{-- <input type="number" name="annonceur_id" value="{{old('annonceur_id')}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: Identifiant annonceur"> --}}
                        <select name="type_de_bien_id" id="exampleInputPassword1" class="form-control">
                            @foreach ($typedebiens as $typedebien )
                                <option value="{{ $typedebien->id }}">{{ $typedebien ->libelle }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Commune <span class="text-danger" >*</span></label>
                        {{-- <input type="number" name="commune_id" value="{{$publication->commune_id}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: Identifiant commune"> --}}
                        <select name="commune_id" id="commune" class="form-control" value="{{$publication->commune_id}}">
                            @foreach ($communes as $commune )
                            <option value="{{ $commune->id }}">{{ $commune ->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Budget <span class="text-danger" >*</span></label>
                        {{-- <input type="number" name="budget_id" value="{{$publication->budget_id}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: Identifiant budget"> --}}
                        <select name="budget_id" id="exampleInputPassword1" class="form-control" value="{{$publication->budget_id}}">
                            @foreach ($budgets as $budget )
                            <option value="{{ $budget->id }}">{{ $budget ->max }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Quartier <span class="text-danger" >*</span></label>
                        {{-- <input type="number" name="quartier_id" value="{{$publication->quartier_id}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: Identifiant budget"> --}}
                        <select name="quartier_id" id="quartier" class="form-control" >
                            @foreach ($quartiers as $quartier )
                            <option value="{{$publication->quartier_id}}">{{ $quartier ->libelle }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Description <span class="text-danger" >*</span></label><br>
                        {{-- <input type="text" name="description" value="{{$publication->description}}" class="form-control" id="exampleInputPassword1" placeholder="Ex: lze biens est situer......"> --}}
                        <textarea name="description" value="{{$publication->description}}" id="exampleInputPassword1"class="form-control"  cols="70" rows="3" placeholder="{{$publication->description}}"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
 </div>




 <script>
    document.addEventListener("DOMContentLoaded", function(){
        const communeSelect = document.getElementById('commune');
        const quartierSelect = document.getElementById('quartier');
        communeSelect.addEventListener("change", function(){
            const selectedCommuneId = communeSelect.value;

            // desactiver le menu deroulant des quartiers si aucune commune n'a ete selectionne
            quartierSelect.disabled = !selectedCommuneId;
            // efface  les options  precedentes
            quartierSelect.innerHTML = "";
            if (selectedCommuneId) {
                 // Chargez les quartiers en fonction de la commune sélectionnée
                 @foreach($quartiers as $quartier)
                    if ({{ $quartier->commune_id }} == selectedCommuneId) {
                        const option = document.createElement("option");
                        option.value = {{ $quartier->id }};
                        option.text = "{{ $quartier->libelle }}";
                        quartierSelect.appendChild(option);
                    }
                @endforeach

            }else {
                // Si aucune commune n'est sélectionnée, affichez un message
                const option = document.createElement("option");
                option.text = "Sélectionnez d'abord une commune";
                quartierSelect.appendChild(option);
            }
        });
    });
 </script>
@endsection
