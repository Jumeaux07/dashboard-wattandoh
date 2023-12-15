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
            <h1>Profil Publication</h1>
            <hr>

            {{-- <div class="row">
                <div class="col-md-4">
                    <!-- Photo de profil -->
                    <img src="{{asset('assets/images/users/profile.svg')}}" alt="Photo de profil" class="img-fluid rounded-circle">
                </div>
                <div class="col-md-8">

                    <h3>{{$publication->reference}}</h3>

                    <p>piece : {{$publication->piece}}</p>
                    <p>caution : {{$publication->caution}}</p>
                    <p>Description : {{$publication->description}}</p>
                </div>
            </div> --}}





       <div class="col-lg-12">
        <div class="card m-b-30">
            <div class="card-header">
                <div class="col-md-4">
                    <!-- Photo de profil -->
                    <img src="{{asset('assets/images/users/profile.svg')}}" alt="Photo de profil" class="img-fluid rounded-circle">
                </div>
                <h5 class="card-title">ANONCEUR : {{$publication->annonceur->nom_prenoms}}</h5>
            </div>
            <div class="card-body">
                <h6 class="card-subtitle">{{$publication->description}} <code class="highlighter-rouge">piece : {{$publication->piece}}</code>. <code class="highlighter-rouge"> caution : {{$publication->caution}}</code>  are applied to the image so that it scales with the parent element.</h6>
                {{-- <img src="{{ asset('assets/images/ui-images/image-responsive.jpg') }}" class="img-fluid" alt="Responsive image"> --}}

                {{-- <img src="{{$publication->images}}" alt="{{$publication->images}}" class="img-fluid"> --}}



                @foreach ($publication->images as $image )
                <img src="{{asset($image->url)}}" alt="{{$image->url}}" class="img-fluid"> <br><br>
                @endforeach
            </div>
        </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <!-- Autres informations ou sections de la page de profil -->
                <h3>Actions</h3>
                <p>
                    <a href="{{route('publications.edit',$publication->id)}}"><button class="btn btn-primary"><i class="feather icon-edit" ></i> <strong>Editer</strong> </button></a>
                    @if ($publication->statut_generique_id == 2)
                    <a href="{{route('publication.statutPub',$publication->id )}}"><button class="btn btn-danger"><i class="fa fa-toggle-off"></i> <strong>Brouillon</strong></button></a>
                    @endif
                    @if ($publication->statut_generique_id == 1)
                    <a href="{{route('publication.statutPub',$publication->id )}}"><button class="btn btn-success"><i class="fa fa-toggle-on"></i> <strong>Publier</strong></button></a>
                    @endif
                </p>
            </div>
        </div>
   </div>






    </div>
 </div>

 @endsection
