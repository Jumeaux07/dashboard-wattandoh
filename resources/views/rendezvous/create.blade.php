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
            <form action="{{route('rendezvous.store')}}" method="post" >
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Reference  <span class="text-danger" >*</span> </label>
                        <input type="text" name="reference" value="{{old('reference')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: jour...">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1"> reference Pulication  <span class="text-danger" >*</span> </label>
                        {{-- <input type="number" name="publication_id" value="{{old('publication_id')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 9999999999"> --}}
                        <select name="publication_id" class="form-control" id="publication" >
                            @foreach ($publications as $publication )
                            <option value="{{ $publication->id }}">{{ $publication->reference }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Client <span class="text-danger" >*</span> </label>
                        {{-- <input type="number" name="client_id" value="{{old('client_id')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 9999999999"> --}}
                        <select name="client_id" class="form-control" id="exampleInputEmail1" >
                            @foreach ($clients as $client )
                            <option value="{{ $client ->id }}">{{ $client ->nom_prenoms }}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Annonceur <span class="text-danger" >*</span> </label>
                        {{-- <input type="number" name="client_id" value="{{old('client_id')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 9999999999"> --}}
                        <select name="annonceur_id" class="form-control" id="annonceur" >
                            @foreach ($annonceurs as $annonceur )
                            <option value="{{ $annonceur ->id }}">{{ $annonceur->nom_prenoms }}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Date  <span class="text-danger" >*</span> </label>
                        <input type="datetime-local" name="date" value="{{old('date')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: date">

                    </div>



                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
 </div>

 <script>
    document.addEventListener("DOMContentLoaded", function(){
        const publicationSelect = document.getElementById('publication');
        const annonceurSelect = document.getElementById('annonceur');
        publicationSelect.addEventListener("change", function(){
            const selectedPublicationId = publicationSelect.value;

            // desactiver le menu deroulant des quartiers si aucune commune n'a ete selectionne
            annonceurSelect.disabled = !selectedPublicationId;
            // efface  les options  precedentes
            annonceurSelect.innerHTML = "";
            if (selectedPublicationId) {
                 // Chargez les quartiers en fonction de la commune sélectionnée
                 @foreach($annonceurs as $annonceur)
                    if ({{ $annonceur->publication_id }} == selectedPublicationId) {
                        const option = document.createElement("option");
                        option.value = {{ $annonceur->id }};
                        option.text = "{{ $annonceur->nom_prenoms }}";
                        annonceurSelect.appendChild(option);
                    }
                @endforeach

            }else {
                // Si aucune commune n'est sélectionnée, affichez un message
                const option = document.createElement("option");
                option.text = "Sélectionnez d'abord une reference de publication";
                quartierSelect.appendChild(option);
            }
        });
    });
 </script>
@endsection
