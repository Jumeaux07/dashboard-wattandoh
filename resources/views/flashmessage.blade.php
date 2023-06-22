
@if (session()->has('message'))
    <div class="alert-list">
        <div class="alert {{session()->get('type')}} alert-dismissible fade show" role="alert">
        <strong>{{session()->get('message')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
    </div>
@endif

@if ( $errors->any())
<div class="alert-list">
    <div class="alert {{session()->get('type')}} alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
            - {!!  $error !!} <br>
        @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
</div>
@else

@endif
