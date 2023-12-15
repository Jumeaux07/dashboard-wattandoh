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
            <form action="{{route('images.store')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">url  <span class="text-danger" >*</span> </label>
                        <input type="file" name="url" value="{{old('url')}}" class="form-control" id="image"  placeholder="Ex: image(.png , .jpg ) " accept="image/*" >
                        <img id="imagePreview" src="" alt="{{old('url')}}"  class="img-fluid rounded-carre">
                       {{-- <input type="image" src="" alt=""> --}}
                        <video id="imagePreview" src="" alt="{{old('url')}}"  class="img-fluid rounded-carre"></video>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Reference de la  Publication <span class="text-danger" >*</span> </label>
                        {{-- <input type="number" name="publication_id" value="{{old('publication_id')}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ex: 999999999 "> --}}
                       <select name="publication_id" class="form-control" id="exampleInputEmail1">
                        @foreach ($publications as $publication )
                            <option value="{{ $publication->id }}">{{ $publication->reference }}</option>
                        @endforeach
                       </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>
    </div>



     {{-- modification a termine plus tard  --}}
    {{-- <div class="row">

        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="card-title">File upload</h5>
                </div>
                <div class="card-body">
                    <form action="#" class="dropzone">
                        <div class="fallback">
                            <input name="file" type="file" multiple="multiple">
                        </div>
                    </form>
                    <div class="text-center m-t-15">
                        <button type="button" class="btn btn-primary">Upload File</button>
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
 </div>


    <!-- Start row -->





 <script>
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
        } else {
            imagePreview.src = ''; // Efface l'aperçu si aucun fichier n'est sélectionné
        }
    });
</script>
@endsection
