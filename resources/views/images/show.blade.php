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
            <div class="col-lg-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="card-title">Reference de la  publication : {{$image->publication->reference}}</h5>
                    </div>
                    <div class="card-body">
                        <h6 class="card-subtitle">Images in Bootstrap are made responsive with <code class="highlighter-rouge">.img-fluid</code>. <code class="highlighter-rouge">max-width: 100%;</code> and <code class="highlighter-rouge">height: auto;</code> are applied to the image so that it scales with the parent element.</h6>
                        <img src="{{$image->url}}" class="img-fluid" alt="Responsive image">
                    </div>
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
