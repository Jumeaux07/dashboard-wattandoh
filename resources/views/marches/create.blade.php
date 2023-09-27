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
            <form action="{{route('marches.store')}}" method="post" >
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Reference  <span class="text-danger" >*</span> </label>
                        <input type="text" name="reference" value="{{old('reference')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: jour...">
                        {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Id rendez vous  <span class="text-danger" >*</span> </label>
                        {{-- <input type="number" name="rendezvous_id" value="{{old('rendezvous_id')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 9999999999"> --}}
                        <select name="rendezvous_id" class="form-control" id="exampleInputEmail1">
                            @foreach ($rendezvous as $rendezvou )
                            <option value="{{ $rendezvou->id }}">{{ $rendezvou->reference }}</option>

                            @endforeach
                        </select>
                    </div>


                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Refernce Publication  <span class="text-danger" >*</span> </label>
                        {{-- <input type="number" name="publication_id" value="{{old('publication_id')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 9999999999"> --}}
                        <select name="publication_id" class="form-control" id="exampleInputEmail1">
                            @foreach ($publications as $publication )
                            <option value="{{ $publication->id }}">{{ $publication->reference }}</option>

                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Client <span class="text-danger" >*</span> </label>
                        {{-- <input type="number" name="client_id" value="{{old('client_id')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 9999999999"> --}}
                        <select name="client_id" class="form-control" id="exampleInputEmail1">
                            @foreach ($clients as $client )
                            <option value="{{ $client->id }}"> {{ $client->nom_prenoms }}</option>

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
