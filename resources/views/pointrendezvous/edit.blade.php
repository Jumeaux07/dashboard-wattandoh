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
            <form action="{{route('rendezvous.update', $rendezvou->id)}}" method="post" >
                @method('put')
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Reference  <span class="text-danger" >*</span> </label>
                        <input type="text" name="reference" value="{{$rendezvou->reference}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: jour....">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">reference publication  <span class="text-danger" >*</span> </label>
                        {{-- <input type="number" name="publication_id" value="{{$rendezvou->publication_id}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 9999999999"> --}}
                        <select name="publication_id" class="form-control" id="exampleInputEmail1" >
                            @foreach ($publications as $publication )
                            <option value="{{$rendezvou->publication_id}}">{{ $publication->reference }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1"> Client  <span class="text-danger" >*</span> </label>
                        {{-- <input type="number" name="client_id" value="{{$rendezvou->client_id}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 9999999999"> --}}
                        <select name="client_id" class="form-control" id="exampleInputEmail1" >
                            @foreach ($clients as $client )
                            <option value="{{$rendezvou->client_id}}">{{ $client ->nom_prenoms }}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1"> Annonceur  <span class="text-danger" >*</span> </label>
                        {{-- <input type="number" name="client_id" value="{{$rendezvou->client_id}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 9999999999"> --}}
                        <select name="annonceur_id" class="form-control" id="exampleInputEmail1" >
                            @foreach ($annonceurs as $annonceur )
                            <option value="{{$rendezvou->annonceur_id}}">{{ $annonceur ->nom_prenoms }}</option>

                            @endforeach

                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Date <span class="text-danger" >*</span> </label>
                        <input type="datetime-local" name="date" value="{{$rendezvou->date}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>



                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>
 </div>
@endsection
