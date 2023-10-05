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
        <div class="container">
            <h1>Profil Image </h1>
            <hr>

            <div class="row">
                <div class="col-md-4">
                    <!-- Photo de profil -->
                    <img src="{{ asset('storage/' . $image->url) }}" alt="Photo de profil" class="img-fluid rounded-circle">
                </div>
                <div class="col-md-8">
                    <!-- Informations utilisateur -->
                    {{-- <h3>{{$image->url}}</h3> --}}
                    <img src="{{$image->url}}" alt="{{$image->url}}" class="img-fluid rounded-circle" height="90px" width="90px" d="image">

                    {{-- <img id="imagePreview" src="" alt="Aperçu de l'image" width="80px" height="80px" class="img-fluid rounded-carre"> --}}
                    <br><p>ID publication : {{$image->publication_id}}</p>
                    {{-- <p>Numero de Telephone 2 : {{$client->phone2}}</p> --}}
                    {{-- <p>Sexe: {{$client->sexe}}</p> --}}
                    {{-- <p>Description : Compte client.</p> --}}
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <!-- Autres informations ou sections de la page de profil -->
                    <h3>Actions</h3>
                    <p>
                        <a href="{{route('images.edit',$image->id)}}"><button class="btn btn-primary"><i class="feather icon-edit" ></i> <strong>Editer</strong> </button></a>
                        {{-- @if ($image->statut_generique_id == 2)
                        <a href="{{route('image.statutImage',$image->id )}}"><button class="btn btn-danger"><i class="fa fa-toggle-off"></i> <strong>Desactiver</strong></button></a>
                        @endif
                        @if ($image->statut_generique_id == 1)
                        <a href="{{route('image.statutImage',$image->id )}}"><button class="btn btn-success"><i class="fa fa-toggle-on"></i> <strong>Activer</strong></button></a>
                        @endif --}}
                    </p>
                </div>
            </div>
        </div>
    </div>
 </div>

 {{-- <script>
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                imagePreview.src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
    });
</script> --}}

 @endsection
